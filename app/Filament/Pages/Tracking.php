<?php

namespace App\Filament\Pages;

use App\Models\Vehicle;
use Filament\Pages\Page;
use Livewire\Attributes\Url;

class Tracking extends Page
{
    protected static ?string $title = 'Posisi Sekarang';
    protected static string|\UnitEnum|null $navigationGroup = 'Pelacakan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationLabel = 'posisi';
    protected string $view = 'filament.pages.tracking';

    // Gunakan #[Url] agar search query muncul di URL browser (opsional)
    #[Url(history: true)]
    public $search = '';

    /**
     * Kita gunakan Computed Property agar data kendaraan 
     * otomatis ter-update saat properti $search berubah.
     */
    public function getVehiclesProperty()
    {
        return Vehicle::query()
            ->with('latestGps') // Pastikan relasi ini ada di Model Vehicle
            ->when($this->search, function ($query) {
                $query->where('license_plate', 'like', '%' . $this->search . '%');
            })
            ->get();
    }

    // Mount sekarang bisa dikosongkan jika tidak ada inisialisasi lain
    public function mount(): void
    {
        //
    }
}