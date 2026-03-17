<?php

namespace App\Filament\Resources\ServiceApprovals\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ServiceApprovalResource;


class EditServiceApproval extends EditRecord
{
    protected static string $resource = ServiceApprovalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
