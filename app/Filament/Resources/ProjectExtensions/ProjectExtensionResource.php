<?php

namespace App\Filament\Resources\ProjectExtensions;

use App\Filament\Resources\ProjectExtensions\Pages\CreateProjectExtension;
use App\Filament\Resources\ProjectExtensions\Pages\EditProjectExtension;
use App\Filament\Resources\ProjectExtensions\Pages\ListProjectExtensions;
use App\Filament\Resources\ProjectExtensions\Schemas\ProjectExtensionForm;
use App\Filament\Resources\ProjectExtensions\Tables\ProjectExtensionsTable;
use App\Models\ProjectExtension;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProjectExtensionResource extends Resource
{
    protected static ?string $model = ProjectExtension::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static string|UnitEnum|null $navigationGroup = 'Project Delivery';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return ProjectExtensionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectExtensionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjectExtensions::route('/'),
            'create' => CreateProjectExtension::route('/create'),
            'edit' => EditProjectExtension::route('/{record}/edit'),
        ];
    }
}
