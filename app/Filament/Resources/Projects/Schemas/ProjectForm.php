<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
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
                                ->required()
                                ->placeholder('PRJ-2026-001'),
                            TextInput::make('project_name')
                                ->required(),
                            Select::make('client_id')
                                ->relationship('client', 'company_name')
                                ->searchable()
                                ->preload()
                                ->required(),
                            Select::make('project_manager_id')
                                ->relationship('projectManager', 'name')
                                ->searchable()
                                ->preload(),
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
                    ]),

                Section::make('Financials & Budgeting')
                    ->schema([
                        Grid::make(3)->schema([
                            TextInput::make('budget')
                                ->numeric()
                                ->prefix('$')
                                ->default(0)
                                ->required(),
                            TextInput::make('expected_profit')
                                ->numeric()
                                ->prefix('$')
                                ->default(0)
                                ->required(),
                            TextInput::make('health_score')
                                ->numeric()
                                ->suffix('/ 100')
                                ->default(100)
                                ->disabled(),
                        ]),
                    ]),

                Section::make('Timeline & Scope')
                    ->schema([
                        Grid::make(4)->schema([
                            DatePicker::make('planned_start_date'),
                            DatePicker::make('planned_end_date'),
                            DatePicker::make('actual_start_date'),
                            DatePicker::make('actual_end_date'),
                        ]),
                        Textarea::make('description')
                            ->columnSpanFull(),
                    ]),
            ]);

    }
}
