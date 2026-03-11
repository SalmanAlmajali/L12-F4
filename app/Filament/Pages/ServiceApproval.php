<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Service;
use App\Models\ServiceDetail;

class ServiceApproval extends Page
{
    protected string $view = 'filament.pages.service-approval';

    protected static ?string $navigationLabel = 'Persetujuan Service';
    protected static ?string $title = 'persetujuan service';

    protected static string|\UnitEnum|null $navigationGroup = 'Nota Dinas';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-check-circle';

    public function approveService($id): void
    {
        $service = Service::find($id);

        if ($service) {
            $service->is_approved = ! $service->is_approved;
            $service->save();
        }
    }

    public function approveItem($id): void
    {
        $item = ServiceDetail::find($id);

        if ($item) {
            $item->is_approved = ! $item->is_approved;
            $item->save();
        }
    }
}