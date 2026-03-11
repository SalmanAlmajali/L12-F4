<?php

namespace App\Filament\Pages;

use App\Models\Vehicle;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\DB;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;

class RekapService extends Page implements HasTable
{
    use InteractsWithTable;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';
    protected static string|\UnitEnum|null $navigationGroup = 'Rekap';
    protected static ?string $navigationLabel = 'Rekap Biaya Service';
    protected static ?string $title = 'Rekap Biaya Service Kendaraan';
    protected string $view = 'filament.pages.rekap-service';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Vehicle::query()
                    ->select([
                        'vehicles.id',
                        'brands.name as nama_merk',
                        'vehicle_types.name as jenis_kendaraan', // Ambil dari tabel vehicle_types
                        'directorates.name as nama_direktorat', // Ambil dari tabel directorates
                        'vehicles.license_plate as plat_nomor',
                        // Menjumlahkan semua biaya spare part dari maintenance_details
                        DB::raw("SUM(COALESCE(maintenance_details.total, 0)) as total_spare_part"),
                        DB::raw("SUM(COALESCE(maintenance_details.total, 0)) as grand_total"),
                    ])
                    ->join('brands', 'vehicles.brand_id', '=', 'brands.id')
                    ->join('vehicle_types', 'vehicles.vehicle_type_id', '=', 'vehicle_types.id')
                    ->join('directorates', 'vehicles.directorate_id', '=', 'directorates.id')
                    ->leftJoin('maintenances', 'vehicles.id', '=', 'maintenances.vehicle_id')
                    ->leftJoin('maintenance_details', 'maintenances.id', '=', 'maintenance_details.maintenance_id')
                    ->groupBy(
                        'vehicles.id', 
                        'brands.name', 
                        'vehicle_types.name', 
                        'directorates.name', 
                        'vehicles.license_plate'
                    )
            )
            ->columns([
                TextColumn::make('nama_merk')
                    ->label('Merk')
                    ->sortable(),
                TextColumn::make('plat_nomor')
                    ->label('No. Polisi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('jenis_kendaraan')
                    ->label('Jenis Kendaraan')
                    ->sortable(),
                TextColumn::make('nama_direktorat')
                    ->label('Direktorat')
                    ->sortable(),
                TextColumn::make('total_spare_part')
                    ->label('Spare Part')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('grand_total')
                    ->label('Total Biaya')
                    ->money('IDR')
                    ->color('success')
                    ->weight('bold')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('tanggal_service')
                    ->form([
                        DatePicker::make('dari_tanggal')->label('Dari Tanggal'),
                        DatePicker::make('sampai_tanggal')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['dari_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('maintenances.date', '>=', $date),
                            )
                            ->when(
                                $data['sampai_tanggal'],
                                fn (Builder $query, $date): Builder => $query->whereDate('maintenances.date', '<=', $date),
                            );
                    })
            ])
            ->defaultSort('vehicles.id', 'asc');
    }
}