<?php

namespace App\Filament\Widgets;

use App\Models\Project;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class ProjectHealthWidget extends TableWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('AI Project Health & Risk Monitor')
            ->description('Real-time composite health telemetry evaluating budget, delivery cadence, and client approval sentiment.')
            ->query(fn (): Builder => Project::with(['client', 'projectManager'])->orderBy('health_score', 'asc'))
            ->columns([
                TextColumn::make('project_code')
                    ->badge()
                    ->color('gray'),
                TextColumn::make('project_name')
                    ->weight('bold')
                    ->searchable(),
                TextColumn::make('client.company_name')
                    ->label('Client'),
                TextColumn::make('budget')
                    ->money('USD'),
                TextColumn::make('health_score')
                    ->label('AI Health')
                    ->badge()
                    ->suffix('%')
                    ->color(fn ($state): string => match (true) {
                        $state >= 80 => 'success',
                        $state >= 60 => 'warning',
                        default => 'danger',
                    }),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'planning' => 'info',
                        'on_hold' => 'warning',
                        'completed' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('planned_end_date')
                    ->label('Target Deadline')
                    ->date(),
            ]);
    }
}
