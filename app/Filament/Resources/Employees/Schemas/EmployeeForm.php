<?php

namespace App\Filament\Resources\Employees\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EmployeeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('team_id')
                    ->relationship('team', 'name'),
                Select::make('department_id')
                    ->relationship('department', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('employee_id')
                    ->required(),
                TextInput::make('full_name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('mobile'),
                TextInput::make('designation')
                    ->required(),
                TextInput::make('hourly_rate')
                    ->required()
                    ->numeric()
                    ->default(50),
                TextInput::make('overtime_rate')
                    ->required()
                    ->numeric()
                    ->default(75),
                DatePicker::make('joining_date'),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
            ]);

    }
}
