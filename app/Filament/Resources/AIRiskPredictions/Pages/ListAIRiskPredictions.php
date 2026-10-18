<?php

namespace App\Filament\Resources\AIRiskPredictions\Pages;

use App\Filament\Resources\AIRiskPredictions\AIRiskPredictionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAIRiskPredictions extends ListRecords
{
    protected static string $resource = AIRiskPredictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
