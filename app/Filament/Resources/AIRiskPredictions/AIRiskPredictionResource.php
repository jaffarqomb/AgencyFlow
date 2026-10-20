<?php

namespace App\Filament\Resources\AIRiskPredictions;

use App\Filament\Resources\AIRiskPredictions\Pages\CreateAIRiskPrediction;
use App\Filament\Resources\AIRiskPredictions\Pages\EditAIRiskPrediction;
use App\Filament\Resources\AIRiskPredictions\Pages\ListAIRiskPredictions;
use App\Filament\Resources\AIRiskPredictions\Schemas\AIRiskPredictionForm;
use App\Filament\Resources\AIRiskPredictions\Tables\AIRiskPredictionsTable;
use App\Models\AIRiskPrediction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class AIRiskPredictionResource extends Resource
{
    protected static ?string $model = AIRiskPrediction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldExclamation;

    protected static string|UnitEnum|null $navigationGroup = 'AI Intelligence';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return AIRiskPredictionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AIRiskPredictionsTable::configure($table);
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
            'index' => ListAIRiskPredictions::route('/'),
            'create' => CreateAIRiskPrediction::route('/create'),
            'edit' => EditAIRiskPrediction::route('/{record}/edit'),
        ];
    }
}
