<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\Client;
use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Core Project Information')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('project_code')
                                ->label('Project Code')
                                ->disabled()
                                ->dehydrated()
                                ->unique(ignoreRecord: true)
                                ->default(function () {
                                    // This generates a visual preview for the user on the "Create" form
                                    $latestId = Project::max('id') ?? 0;

                                    return 'PRJ-'.date('Y').'-'.str_pad($latestId + 1, 4, '0', STR_PAD_LEFT);
                                }),
                            TextInput::make('project_name')
                                ->label('Project Name')
                                ->required(),
                            Select::make('client_id')
                                ->label('Client or Company Name')
                                ->options(Client::pluck('company_name', 'id'))
                                ->searchable()
                                ->preload()
                                ->required(),
                            Select::make('project_manager_id')
                                ->relationship('projectManager', 'name')
                                ->searchable()
                                ->preload(),
                            Select::make('services')
                                ->label('Services')
                                ->relationship('services', 'name')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->live()
                                ->afterStateUpdated(
                                    fn (Get $get, Set $set, ?array $state): mixed => $set(
                                        'expected_profit',
                                        Project::calculateExpectedProfitForServices(
                                            $get('budget') ?? 0,
                                            $state ?? [],
                                        ),
                                    ),
                                ),
                            Select::make('status')
                                ->options([
                                    'draft' => 'Draft',
                                    'planning' => 'Planning',
                                    'active' => 'Active',
                                    'on_hold' => 'On Hold',
                                    'completed' => 'Completed',
                                    'cancelled' => 'Cancelled',
                                ])
                                ->default('planning')
                                ->required(),
                            TextInput::make('currency')
                                ->default('USD')
                                ->required(),
                        ]),
                    ])->columnSpanFull(),

                Section::make('Financials & Budgeting')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('budget')
                                ->label('Budget')
                                ->numeric()
                                ->prefix('$')
                                ->default(0)
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(
                                    fn (Get $get, Set $set, $state): mixed => $set(
                                        'expected_profit',
                                        Project::calculateExpectedProfitForServices(
                                            $state ?? 0,
                                            $get('services') ?? [],
                                        ),
                                    ),
                                ),
                            TextInput::make('expected_profit')
                                ->label('Expected Profit')
                                ->numeric()
                                ->prefix('$')
                                ->default(0)
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->helperText('Budget minus the estimated cost of selected services.'),
                            TextInput::make('health_score')
                                ->label('Health Score')
                                ->numeric()
                                ->suffix('/ 100')
                                ->default(100)
                                ->disabled()
                                ->dehydrated()
                                ->helperText('Calculated from schedule, budget, risks, stages, client satisfaction, workload, and open issues.')
                                ->afterStateHydrated(
                                    fn (Set $set, ?Project $record): mixed => $record
                                        ? $set('health_score', $record->calculateHealthScore())
                                        : null,
                                ),
                        ]),
                    ]),
                Section::make('Timeline & Scope')
                    ->schema([
                        Grid::make(4)->schema([
                            DatePicker::make('planned_start_date')->label('Planned Start Date'),
                            DatePicker::make('planned_end_date')->label('Planned End Date'),
                            DatePicker::make('actual_start_date')->label('Actual Start Date'),
                            DatePicker::make('actual_end_date')->label('Actual End Date'),

                        ]),
                        Textarea::make('description')
                            ->label('Project Description'),

                    ]),
            ]);

    }
}
