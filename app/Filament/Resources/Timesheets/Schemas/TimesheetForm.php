<?php

namespace App\Filament\Resources\Timesheets\Schemas;

use App\Models\Employee;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TimesheetForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->options(Employee::pluck('full_name', 'id'))
                    ->required(),
                Select::make('project_id')
                    ->relationship('project', 'id')
                    ->required(),
                Select::make('stage_id')
                    ->relationship('stage', 'name'),
                Select::make('task_id')
                    ->relationship('task', 'title'),
                DatePicker::make('date')
                    ->required(),
                TextInput::make('hours')
                    ->required()
                    ->numeric(),
                TextInput::make('labor_cost')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('approved'),
            ]);

    }
}
