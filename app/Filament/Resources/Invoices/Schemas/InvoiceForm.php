<?php

namespace App\Filament\Resources\Invoices\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InvoiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('invoice_number')
                    ->required(),
                Select::make('client_id')
                    ->relationship('client', 'id')
                    ->required(),
                Select::make('project_id')
                    ->relationship('project', 'id'),
                Select::make('quotation_id')
                    ->relationship('quotation', 'title'),
                DatePicker::make('issue_date')
                    ->required(),
                DatePicker::make('due_date')
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
                TextInput::make('amount_paid')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('status')
                    ->required()
                    ->default('draft'),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);

    }
}
