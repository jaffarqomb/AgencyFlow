<?php

namespace App\Filament\Resources\ProjectExtensions\Pages;

use App\Filament\Resources\ProjectExtensions\ProjectExtensionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProjectExtension extends EditRecord
{
    protected static string $resource = ProjectExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
