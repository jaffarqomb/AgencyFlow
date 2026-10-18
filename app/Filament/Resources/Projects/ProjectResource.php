<?php

namespace App\Filament\Resources\Projects;

use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Filament\Resources\Projects\Pages\EditProject;
use App\Filament\Resources\Projects\Pages\ListProjects;
use App\Models\Project;
use App\Services\AI\AIService;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static string|UnitEnum|null $navigationGroup = 'Project Delivery';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
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

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project_code')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project_name')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.company_name')
                    ->label('Client')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('projectManager.name')
                    ->label('PM')
                    ->toggleable(),
                TextColumn::make('budget')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'planning' => 'info',
                        'on_hold' => 'warning',
                        'completed' => 'primary',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('health_score')
                    ->label('AI Health')
                    ->badge()
                    ->suffix('%')
                    ->color(fn ($state): string => match (true) {
                        $state >= 80 => 'success',
                        $state >= 60 => 'warning',
                        default => 'danger',
                    })
                    ->sortable(),
                TextColumn::make('planned_end_date')
                    ->label('Deadline')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'planning' => 'Planning',
                        'on_hold' => 'On Hold',
                        'completed' => 'Completed',
                    ]),
            ])
            ->recordActions([
                Action::make('ai_risk_analysis')
                    ->label('AI Risk')
                    ->icon(Heroicon::OutlinedSparkles)
                    ->color('primary')
                    ->action(function (Project $record) {
                        $aiService = app(AIService::class);
                        $result = $aiService->predictAndPersistRisk($record);

                        Notification::make()
                            ->title("AI Risk Assessment: {$result['risk_level']} Risk ({$result['probability_score']}%)")
                            ->body(implode(' ', $result['recommendations']))
                            ->color($result['risk_level'] === 'low' ? 'success' : 'danger')
                            ->send();
                    }),
                Action::make('ai_health_check')
                    ->label('Health')
                    ->icon(Heroicon::OutlinedHeart)
                    ->color('success')
                    ->action(function (Project $record) {
                        $aiService = app(AIService::class);
                        $result = $aiService->evaluateAndPersistHealth($record);

                        Notification::make()
                            ->title("Project Health Updated: {$result['score']}/100")
                            ->body($result['summary'])
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
