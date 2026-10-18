<?php

namespace App\Filament\Resources\AIRiskPredictions;

use App\Filament\Resources\AIRiskPredictions\Pages\CreateAIRiskPrediction;
use App\Filament\Resources\AIRiskPredictions\Pages\EditAIRiskPrediction;
use App\Filament\Resources\AIRiskPredictions\Pages\ListAIRiskPredictions;
use App\Models\AIRiskPrediction;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
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
        return $schema
            ->components([
                Select::make('project_id')
                    ->relationship('project', 'id')
                    ->required(),
                TextInput::make('risk_type')
                    ->required(),
                TextInput::make('risk_level')
                    ->required(),
                TextInput::make('probability_score')
                    ->required()
                    ->numeric(),
                Textarea::make('recommendations')
                    ->columnSpanFull(),
                DateTimePicker::make('evaluated_at')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.id')
                    ->searchable(),
                TextColumn::make('risk_type')
                    ->searchable(),
                TextColumn::make('risk_level')
                    ->searchable(),
                TextColumn::make('probability_score')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('evaluated_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
