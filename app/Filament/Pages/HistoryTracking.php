<?php

namespace App\Filament\Pages;

use App\Models\Vehicle;
use App\Models\GpsLog; // Asumsi nama model log GPS kamu
use Filament\Pages\Page;
use Livewire\Attributes\Url;

class HistoryTracking extends Page
{
    protected static ?string $title = 'History Perjalanan';
   protected static string|\UnitEnum|null $navigationGroup = 'Pelacakan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';
    protected string $view = 'filament.pages.history-tracking';

    public $selectedVehicle = '';
    public $selectedDate = '';

    // Fungsi untuk mengambil data rute saat tombol "GO" diklik
    public function getRouteData()
{
    if (!$this->selectedVehicle || !$this->selectedDate) return [];

    // Ambil data kendaraan dulu untuk mendapatkan string plat nomornya
    $vehicle = \App\Models\Vehicle::find($this->selectedVehicle);
    
    if (!$vehicle) return [];

    return \App\Models\GpsLog::query()
        ->where('license_plate', $vehicle->license_plate) // Sesuaikan dengan migrasi kamu
        ->whereDate('logged_at', $this->selectedDate)      // Gunakan logged_at sesuai migrasi
        ->orderBy('logged_at', 'asc')
        ->get(['latitude', 'longitude', 'logged_at'])
        ->map(fn($log) => [
            'lat' => $log->latitude,
            'lng' => $log->longitude,
            'time' => $log->logged_at->format('H:i')
        ])->toArray();
}
    public function updated($propertyName)
{
    if (in_array($propertyName, ['selectedVehicle', 'selectedDate'])) {
        $coords = $this->getRouteData();
        $this->dispatch('render-route', coords: $coords);
    }
}
}