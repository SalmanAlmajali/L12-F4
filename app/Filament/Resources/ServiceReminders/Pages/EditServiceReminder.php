<?php

namespace App\Filament\Resources\ServiceReminders\Pages;

use App\Filament\Resources\ServiceReminders\ServiceReminderResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceReminder extends EditRecord
{
    protected static string $resource = ServiceReminderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
