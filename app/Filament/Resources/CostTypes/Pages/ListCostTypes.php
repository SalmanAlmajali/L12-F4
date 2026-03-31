<?php

namespace App\Filament\Resources\CostTypes\Pages;

use App\Filament\Resources\CostTypes\CostTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCostTypes extends ListRecords
{
    protected static string $resource = CostTypeResource::class;

    protected static ?string $title = 'Daftar Jenis Biaya';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah Jenis Biaya')
                ->modalWidth('md'),
        ];
    }
}
