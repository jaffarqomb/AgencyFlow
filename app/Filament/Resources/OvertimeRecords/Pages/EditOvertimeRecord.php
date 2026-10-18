<?php

namespace App\Filament\Resources\OvertimeRecords\Pages;

use App\Filament\Resources\OvertimeRecords\OvertimeRecordResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditOvertimeRecord extends EditRecord
{
    protected static string $resource = OvertimeRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
