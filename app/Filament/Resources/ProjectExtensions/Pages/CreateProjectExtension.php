<?php

namespace App\Filament\Resources\ProjectExtensions\Pages;

use App\Filament\Resources\ProjectExtensions\ProjectExtensionResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProjectExtension extends CreateRecord
{
    protected static string $resource = ProjectExtensionResource::class;
}
