<?php

namespace App\Filament\Resources\StnkReminders\Pages;

use App\Filament\Resources\StnkReminders\StnkReminderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStnkReminder extends EditRecord
{
    protected static string $resource = StnkReminderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
