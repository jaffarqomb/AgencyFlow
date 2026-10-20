<?php

namespace App\Filament\Resources\OvertimeRecords;

use App\Filament\Resources\OvertimeRecords\Pages\CreateOvertimeRecord;
use App\Filament\Resources\OvertimeRecords\Pages\EditOvertimeRecord;
use App\Filament\Resources\OvertimeRecords\Pages\ListOvertimeRecords;
use App\Filament\Resources\OvertimeRecords\Schemas\OvertimeRecordForm;
use App\Filament\Resources\OvertimeRecords\Tables\OvertimeRecordsTable;
use App\Models\OvertimeRecord;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class OvertimeRecordResource extends Resource
{
    protected static ?string $model = OvertimeRecord::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFire;

    protected static string|UnitEnum|null $navigationGroup = 'Agency Talent';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return OvertimeRecordForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OvertimeRecordsTable::configure($table);
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
            'index' => ListOvertimeRecords::route('/'),
            'create' => CreateOvertimeRecord::route('/create'),
            'edit' => EditOvertimeRecord::route('/{record}/edit'),
        ];
    }
}
