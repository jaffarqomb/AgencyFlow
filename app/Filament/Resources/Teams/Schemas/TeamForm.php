<?php

namespace App\Filament\Resources\Teams\Schemas;

use App\Models\Team;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class TeamForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Team Details')
                    ->schema([

                        TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->unique(Team::class, 'slug', ignoreRecord: true)
                            ->helperText('Slug is auto generated from Team name'),

                        Select::make('lead_user_id')
                            ->label('Lead User')
                            ->options(User::pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required(),
                        TextInput::make('capacity_hours_per_week')
                            ->required()
                            ->numeric()
                            ->default(160)
                            ->helperText('Default capacity is 160 hours per week'),
                        Textarea::make('description')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }
}
