<?php

namespace App\Filament\Resources\ProjectExtensions\Pages;

use App\Filament\Resources\ProjectExtensions\ProjectExtensionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProjectExtensions extends ListRecords
{
    protected static string $resource = ProjectExtensionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
