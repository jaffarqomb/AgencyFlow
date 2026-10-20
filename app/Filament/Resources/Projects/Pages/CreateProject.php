<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Project;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['expected_profit'] = Project::calculateExpectedProfitForServices(
            $data['budget'] ?? 0,
            $data['services'] ?? [],
        );

        return $data;
    }

    protected function afterCreate(): void
    {
        $this->record->recalculateHealthScore();
    }
}
