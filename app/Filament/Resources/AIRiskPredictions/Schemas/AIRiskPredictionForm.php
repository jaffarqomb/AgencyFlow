<?php

namespace App\Filament\Resources\AIRiskPredictions\Schemas;

use App\Models\Project;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class AIRiskPredictionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->label('Project')
                    ->options(Project::pluck('project_name', 'id'))
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('risk_type')
                    ->required(),
                TextInput::make('risk_level')
                    ->required(),
                TextInput::make('probability_score')
                    ->required()
                    ->numeric(),
                Textarea::make('recommendations')
                    ->columnSpanFull(),
                DateTimePicker::make('evaluated_at')
                    ->required(),
            ]);

    }
}
