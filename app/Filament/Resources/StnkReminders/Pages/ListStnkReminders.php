<?php

namespace App\Filament\Resources\StnkReminders\Pages;

use App\Filament\Resources\StnkReminders\StnkReminderResource;
use Filament\Resources\Pages\ListRecords;

class ListStnkReminders extends ListRecords
{
    protected static string $resource = StnkReminderResource::class;

    protected function getHeaderActions(): array
    {
        // Kosongkan array ini agar tombol "Buat" hilang total
        return [];
    }
}