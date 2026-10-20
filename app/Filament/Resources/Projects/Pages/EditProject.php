<?php

namespace App\Filament\Resources\Projects\Pages;

use App\Filament\Resources\Projects\ProjectResource;
use App\Models\Project;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['expected_profit'] = Project::calculateExpectedProfitForServices(
            $data['budget'] ?? 0,
            $data['services'] ?? [],
        );

        return $data;
    }

    protected function afterSave(): void
    {
        $this->record->recalculateHealthScore();
    }
}
