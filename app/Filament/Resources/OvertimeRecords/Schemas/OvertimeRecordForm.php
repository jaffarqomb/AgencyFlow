<?php

namespace App\Filament\Resources\OvertimeRecords\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OvertimeRecordForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('employee_id')
                    ->relationship('employee', 'id')
                    ->required(),
                Select::make('project_id')
                    ->relationship('project', 'id')
                    ->required(),
                Select::make('task_id')
                    ->relationship('task', 'title'),
                DatePicker::make('date')
                    ->required(),
                TextInput::make('overtime_hours')
                    ->required()
                    ->numeric(),
                TextInput::make('overtime_rate')
                    ->required()
                    ->numeric(),
                TextInput::make('overtime_cost')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Textarea::make('reason')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                TextInput::make('approved_by')
                    ->numeric(),
            ]);

    }
}
