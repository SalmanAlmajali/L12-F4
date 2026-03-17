<?php

namespace App\Filament\Resources\ServiceApprovals\Pages;

// PERBAIKAN: Harus mengarah ke Resources (karena filenya sudah kita keluarkan)
use App\Filament\Resources\ServiceApprovalResource; 
use Filament\Resources\Pages\ListRecords;

class ListServiceApprovals extends ListRecords
{
    protected static string $resource = ServiceApprovalResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\ServiceStats::class,
        ];
    }
}