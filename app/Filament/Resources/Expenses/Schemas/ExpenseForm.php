<?php

namespace App\Filament\Resources\Expenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExpenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->relationship('project', 'id'),
                Select::make('vendor_id')
                    ->relationship('vendor', 'id'),
                TextInput::make('category')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                DatePicker::make('expense_date')
                    ->required(),
                TextInput::make('receipt_path'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('approved'),
            ]);

    }
}
