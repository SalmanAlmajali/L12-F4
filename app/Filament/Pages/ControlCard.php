<?php

namespace App\Filament\Pages;

use App\Livewire\ControlCardTable;
use App\Models\Vehicle;
use Filament\Pages\Page;

class ControlCard extends Page
{
protected static ?string $title = 'Kartu Kendali';
    protected static string|\UnitEnum|null $navigationGroup = 'Service';
protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected string $view = 'filament.pages.control-card';

    public ?int $year = null;
    public ?int $vehicle_id = null;

    protected function getHeaderWidgets(): array
    {
        return [
            ControlCardTable::class,
        ];
    }
}