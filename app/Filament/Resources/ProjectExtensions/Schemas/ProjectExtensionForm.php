<?php

namespace App\Filament\Resources\ProjectExtensions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProjectExtensionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->relationship('project', 'id')
                    ->required(),
                Select::make('stage_id')
                    ->relationship('stage', 'name'),
                TextInput::make('requested_by')
                    ->required()
                    ->numeric(),
                DatePicker::make('current_deadline')
                    ->required(),
                DatePicker::make('new_deadline')
                    ->required(),
                Textarea::make('reason')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('extra_hours')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('extra_cost')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                Textarea::make('rejection_reason')
                    ->columnSpanFull(),
                DateTimePicker::make('approved_at'),
            ]);

    }
}
