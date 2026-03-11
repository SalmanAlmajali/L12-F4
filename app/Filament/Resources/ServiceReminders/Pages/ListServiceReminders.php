<?php

namespace App\Filament\Resources\ServiceReminders\Pages;

use App\Filament\Resources\ServiceReminders\ServiceReminderResource;
use Filament\Resources\Pages\ListRecords;

class ListServiceReminders extends ListRecords
{
    protected static string $resource = ServiceReminderResource::class;

   protected function getHeaderActions(): array
{
    return []; // Tombol "Buat" tidak akan muncul
}
}
