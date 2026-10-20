<?php

namespace App\Filament\Resources\AISettings\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AISettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('provider')
                    ->required()
                    ->default('openai'),
                Textarea::make('api_key')
                    ->columnSpanFull(),
                TextInput::make('model_name')
                    ->required()
                    ->default('gpt-4o'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('temperature')
                    ->required()
                    ->numeric()
                    ->default(0.7),
                TextInput::make('max_tokens')
                    ->required()
                    ->numeric()
                    ->default(2048),
                TextInput::make('monthly_budget_usd')
                    ->required()
                    ->numeric()
                    ->default(100),
                TextInput::make('total_spent_usd')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);

    }
}
