<?php

namespace App\Filament\Resources\AIRiskPredictions\Pages;

use App\Filament\Resources\AIRiskPredictions\AIRiskPredictionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAIRiskPrediction extends EditRecord
{
    protected static string $resource = AIRiskPredictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
