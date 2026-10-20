<?php

namespace App\Filament\Resources\Quotations\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('quotation_number')
                    ->required(),
                Select::make('client_id')
                    ->relationship('client', 'id')
                    ->required(),
                Select::make('project_id')
                    ->relationship('project', 'id'),
                TextInput::make('title')
                    ->required(),
                TextInput::make('subtotal')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('tax_rate')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('tax_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                DatePicker::make('valid_until'),
                Textarea::make('scope_summary')
                    ->columnSpanFull(),
            ]);

    }
}
