<?php

namespace App\Filament\Resources\Deliverables;

use App\Filament\Resources\Deliverables\Pages\CreateDeliverable;
use App\Filament\Resources\Deliverables\Pages\EditDeliverable;
use App\Filament\Resources\Deliverables\Pages\ListDeliverables;
use App\Filament\Resources\Deliverables\Schemas\DeliverableForm;
use App\Filament\Resources\Deliverables\Tables\DeliverablesTable;
use App\Models\Deliverable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DeliverableResource extends Resource
{
    protected static ?string $model = Deliverable::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSwatch;

    protected static string|UnitEnum|null $navigationGroup = 'Project Delivery';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return DeliverableForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DeliverablesTable::configure($table);
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
            'index' => ListDeliverables::route('/'),
            'create' => CreateDeliverable::route('/create'),
            'edit' => EditDeliverable::route('/{record}/edit'),
        ];
    }
}
