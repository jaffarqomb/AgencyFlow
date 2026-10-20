<?php

namespace App\Filament\Resources\Tasks\Schemas;

use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TaskForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project.name')
                    ->label('Project')
                    ->options(Project::pluck('project_name', 'id'))
                    ->required(),
                Select::make('stage_id')
                    ->relationship('stage', 'name'),
                TextInput::make('assigned_to')
                    ->numeric(),
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('priority')
                    ->required()
                    ->default('medium'),
                DatePicker::make('start_date'),
                DatePicker::make('due_date'),
                TextInput::make('estimated_hours')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('actual_hours')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
            ]);

    }
}
