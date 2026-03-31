<?php

namespace App\Filament\Resources\VehicleTypes\Pages;

use App\Filament\Resources\VehicleTypes\VehicleTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListVehicleTypes extends ListRecords
{
    protected static string $resource = VehicleTypeResource::class;

    protected static ?string $title = 'Daftar Jenis Kendaraan';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Jenis Kendaraan')
                ->modalWidth('md'),
        ];
    }
}
