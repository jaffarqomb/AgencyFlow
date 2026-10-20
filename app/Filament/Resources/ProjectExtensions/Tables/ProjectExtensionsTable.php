<?php

namespace App\Filament\Resources\ProjectExtensions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectExtensionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.id')
                    ->searchable(),
                TextColumn::make('stage.name')
                    ->searchable(),
                TextColumn::make('requested_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('current_deadline')
                    ->date()
                    ->sortable(),
                TextColumn::make('new_deadline')
                    ->date()
                    ->sortable(),
                TextColumn::make('extra_hours')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('extra_cost')
                    ->money()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('approved_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);

    }
}
