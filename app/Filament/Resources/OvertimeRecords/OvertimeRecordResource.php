<?php

namespace App\Filament\Resources\OvertimeRecords;

use App\Filament\Resources\OvertimeRecords\Pages\CreateOvertimeRecord;
use App\Filament\Resources\OvertimeRecords\Pages\EditOvertimeRecord;
use App\Filament\Resources\OvertimeRecords\Pages\ListOvertimeRecords;
use App\Models\OvertimeRecord;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
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
        return $schema
            ->components([
                Select::make('employee_id')
                    ->relationship('employee', 'id')
                    ->required(),
                Select::make('project_id')
                    ->relationship('project', 'id')
                    ->required(),
                Select::make('task_id')
                    ->relationship('task', 'title'),
                DatePicker::make('date')
                    ->required(),
                TextInput::make('overtime_hours')
                    ->required()
                    ->numeric(),
                TextInput::make('overtime_rate')
                    ->required()
                    ->numeric(),
                TextInput::make('overtime_cost')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                Textarea::make('reason')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
                TextInput::make('approved_by')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee.id')
                    ->searchable(),
                TextColumn::make('project.id')
                    ->searchable(),
                TextColumn::make('task.title')
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->sortable(),
                TextColumn::make('overtime_hours')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('overtime_rate')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('overtime_cost')
                    ->money()
                    ->sortable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('approved_by')
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
            'index' => ListOvertimeRecords::route('/'),
            'create' => CreateOvertimeRecord::route('/create'),
            'edit' => EditOvertimeRecord::route('/{record}/edit'),
        ];
    }
}
