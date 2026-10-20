<?php

namespace App\Filament\Resources\Deliverables\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DeliverableForm
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
                TextInput::make('title')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('current_status')
                    ->required()
                    ->default('draft'),
                DatePicker::make('due_date'),
            ]);

    }
}
