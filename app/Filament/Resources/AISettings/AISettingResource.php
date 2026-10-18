<?php

namespace App\Filament\Resources\AISettings;

use App\Filament\Resources\AISettings\Pages\CreateAISetting;
use App\Filament\Resources\AISettings\Pages\EditAISetting;
use App\Filament\Resources\AISettings\Pages\ListAISettings;
use App\Models\AISetting;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
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
        return $schema
            ->components([
                TextInput::make('provider')
                    ->required()
                    ->default('openai'),
                Textarea::make('api_key')
                    ->columnSpanFull(),
                TextInput::make('model_name')
                    ->required()
                    ->default('gpt-4o'),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('temperature')
                    ->required()
                    ->numeric()
                    ->default(0.7),
                TextInput::make('max_tokens')
                    ->required()
                    ->numeric()
                    ->default(2048),
                TextInput::make('monthly_budget_usd')
                    ->required()
                    ->numeric()
                    ->default(100),
                TextInput::make('total_spent_usd')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('provider')
                    ->searchable(),
                TextColumn::make('model_name')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('temperature')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('max_tokens')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('monthly_budget_usd')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('total_spent_usd')
                    ->numeric()
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
            'index' => ListAISettings::route('/'),
            'create' => CreateAISetting::route('/create'),
            'edit' => EditAISetting::route('/{record}/edit'),
        ];
    }
}
