<?php

namespace App\Filament\Resources\Projects\Tables;

use App\Models\Project;
use App\Services\AI\AIService;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project_code')
                    ->label('Project Code')
                    ->badge()
                    ->color('gray')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('project_name')
                    ->label('Project Name')
                    ->weight('bold')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('client.company_name')
                    ->label('Client or Company Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('projectManager.name')
                    ->label('Project Manager')
                    ->toggleable(),
                TextColumn::make('budget')
                    ->money('USD')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
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
}
