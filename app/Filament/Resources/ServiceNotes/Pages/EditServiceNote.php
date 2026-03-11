<?php

namespace App\Filament\Resources\ServiceNotes\Pages;

use App\Filament\Resources\ServiceNotes\ServiceNoteResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServiceNote extends EditRecord
{
    protected static string $resource = ServiceNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
