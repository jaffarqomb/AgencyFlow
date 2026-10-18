<?php

namespace App\Filament\Resources\ProjectExtensions;

use App\Filament\Resources\ProjectExtensions\Pages\CreateProjectExtension;
use App\Filament\Resources\ProjectExtensions\Pages\EditProjectExtension;
use App\Filament\Resources\ProjectExtensions\Pages\ListProjectExtensions;
use App\Models\ProjectExtension;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
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

class ProjectExtensionResource extends Resource
{
    protected static ?string $model = ProjectExtension::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static string|UnitEnum|null $navigationGroup = 'Project Delivery';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->relationship('project', 'id')
                    ->required(),
                Select::make('stage_id')
                    ->relationship('stage', 'name'),
                TextInput::make('requested_by')
                    ->required()
                    ->numeric(),
                DatePicker::make('current_deadline')
                    ->required(),
                DatePicker::make('new_deadline')
                    ->required(),
                Textarea::make('reason')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('extra_hours')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('extra_cost')
                    ->required()
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                Textarea::make('rejection_reason')
                    ->columnSpanFull(),
                DateTimePicker::make('approved_at'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.id')
                    ->searchable(),
                TextColumn::make('stage.name')
                    ->searchable(),
                TextColumn::make('requested_by')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('current_deadline')
                    ->date()
                    ->sortable(),
                TextColumn::make('new_deadline')
                    ->date()
                    ->sortable(),
                TextColumn::make('extra_hours')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('extra_cost')
                    ->money()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('approved_at')
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
            'index' => ListProjectExtensions::route('/'),
            'create' => CreateProjectExtension::route('/create'),
            'edit' => EditProjectExtension::route('/{record}/edit'),
        ];
    }
}
