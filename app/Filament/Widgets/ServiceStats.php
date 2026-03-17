<?php

namespace App\Filament\Widgets;

use App\Models\Service;
use App\Models\ServiceDetail;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ServiceStats extends BaseWidget
{
    // Interval refresh otomatis (non-static untuk Filament v4)
    protected ?string $pollingInterval = '15s';

    protected function getStats(): array
    {
        // Menghitung data berdasarkan kolom yang ada di database kamu
        $total = Service::count();
        
        // Menghitung yang sudah di-approve
        $approved = Service::where('is_approved', true)->count();
        
        // FIX: Menggunakan 'total_cost' sesuai kolom tabel services kamu
        $totalCost = Service::sum('total_cost');

        // Menghitung jumlah item sparepart dari tabel detail
        $totalSparepart = ServiceDetail::count();

        return [
            Stat::make('Total Kendaraan', $total)
                ->description('Total pengajuan service')
                ->descriptionIcon('heroicon-m-truck')
                ->color('primary'),

            Stat::make('Sudah Disetujui', "{$approved} / {$total}")
                ->description('Status persetujuan nota')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Total Biaya', 'Rp ' . number_format($totalCost, 0, ',', '.'))
                ->description('Akumulasi biaya seluruhnya')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('warning'),
                
            Stat::make('Total Sparepart', $totalSparepart)
                ->description('Jumlah item sparepart')
                ->descriptionIcon('heroicon-m-wrench-screwdriver')
                ->color('info'),
        ];
    }
}