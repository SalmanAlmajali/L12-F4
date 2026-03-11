<?php

namespace App\Filament\Resources\ServiceNotes\Pages;

use App\Filament\Resources\ServiceNotes\ServiceNoteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServiceNotes extends ListRecords
{
    protected static string $resource = ServiceNoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
