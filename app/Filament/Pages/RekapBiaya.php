<?php

namespace App\Filament\Pages;

use App\Models\MaintenanceDetail;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class RekapBiaya extends Page implements HasTable
{
    use InteractsWithTable;

    protected string $view = 'filament.pages.rekap-biaya';

    public static function getNavigationIcon(): ?string { return 'heroicon-o-calculator'; }
    public static function getNavigationGroup(): ?string { return 'Rekap'; }
    public function getTitle(): string { return 'Rekap Biaya'; }

    /**
     * SOLUSI FINAL: 
     * Harus PUBLIC agar sesuai dengan Interface HasTable.
     * Mengambil data mentah sebagai Collection untuk menghindari manipulasi SQL oleh Filament.
     */
    public function getTableRecords(): Collection|Paginator
    {
        return MaintenanceDetail::query()
            ->select([
                DB::raw("MIN(maintenance_details.id) as id"),
                'vehicle_types.name as jenis',
                'directorates.name as direktorat',
                DB::raw("COUNT(DISTINCT vehicles.id) as jumlah"),
                DB::raw("SUM(maintenance_details.total) as biaya"),
            ])
            ->join('maintenances', 'maintenance_details.maintenance_id', '=', 'maintenances.id')
            ->join('vehicles', 'maintenances.vehicle_id', '=', 'vehicles.id')
            ->join('vehicle_types', 'vehicles.vehicle_type_id', '=', 'vehicle_types.id')
            ->join('directorates', 'vehicles.directorate_id', '=', 'directorates.id')
            ->groupBy('vehicle_types.name', 'directorates.name')
            ->orderBy('biaya', 'desc')
            ->get();
    }

    public function table(Table $table): Table
    {
        return $table
            /**
             * Kita berikan query kosong yang valid. 
             * Filament tidak akan menjalankan query ini karena records sudah kita ambil manual di atas.
             */
            ->query(MaintenanceDetail::query()->whereRaw('1 = 0')) 
            ->columns([
                TextColumn::make('jenis')
                    ->label('Jenis Kendaraan'),
                TextColumn::make('direktorat')
                    ->label('Direktorat'),
                TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->alignCenter(),
                TextColumn::make('biaya')
                    ->label('Total Biaya')
                    ->money('IDR'),
            ])
            ->paginated(false)
            ->searchable(false);
    }
    

    /**
     * Memastikan tidak ada pengurutan otomatis yang merusak query dummy.
     */
    public function getDefaultTableSortColumn(): ?string { return null; }
    public function getDefaultTableSortDirection(): ?string { return null; }
}