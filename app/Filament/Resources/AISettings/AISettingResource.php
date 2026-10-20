<?php

namespace App\Filament\Resources\AISettings;

use App\Filament\Resources\AISettings\Pages\CreateAISetting;
use App\Filament\Resources\AISettings\Pages\EditAISetting;
use App\Filament\Resources\AISettings\Pages\ListAISettings;
use App\Filament\Resources\AISettings\Schemas\AISettingForm;
use App\Filament\Resources\AISettings\Tables\AISettingsTable;
use App\Models\AISetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AISettingResource extends Resource
{
    protected static ?string $model = AISetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCpuChip;

    protected static string|UnitEnum|null $navigationGroup = 'AI Intelligence';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return AISettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AISettingsTable::configure($table);
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
            'index' => ListAISettings::route('/'),
            'create' => CreateAISetting::route('/create'),
            'edit' => EditAISetting::route('/{record}/edit'),
        ];
    }
}
