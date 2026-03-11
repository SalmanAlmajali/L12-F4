<?php

namespace App\Filament\Resources\ServiceNotes\Pages;

use App\Filament\Resources\ServiceNotes\ServiceNoteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceNote extends CreateRecord
{
    protected static string $resource = ServiceNoteResource::class;
}
