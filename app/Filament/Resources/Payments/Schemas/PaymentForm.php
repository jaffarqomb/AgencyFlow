<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('invoice_id')
                    ->relationship('invoice', 'id')
                    ->required(),
                TextInput::make('payment_reference')
                    ->required(),
                TextInput::make('amount')
                    ->required()
                    ->numeric(),
                DatePicker::make('payment_date')
                    ->required(),
                TextInput::make('payment_method')
                    ->required()
                    ->default('bank_transfer'),
                TextInput::make('payment_type')
                    ->required()
                    ->default('milestone'),
                Textarea::make('notes')
                    ->columnSpanFull(),
            ]);

    }
}
