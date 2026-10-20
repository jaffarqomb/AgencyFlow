<?php

namespace App\Filament\Resources\Clients\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('company_name')
                    ->required(),
                TextInput::make('industry'),
                TextInput::make('contact_person')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('mobile'),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('website')
                    ->url(),
                Textarea::make('address')
                    ->columnSpanFull(),
                TextInput::make('vat_number'),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                Select::make('portal_user_id')
                    ->relationship('portalUser', 'name'),
            ]);

    }
}
