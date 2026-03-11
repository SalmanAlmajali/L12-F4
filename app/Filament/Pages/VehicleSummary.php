<?php

namespace App\Filament\Pages;

use App\Models\Vehicle;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Grouping\Group;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction; 
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use BackedEnum;
use UnitEnum;

class VehicleSummary extends Page implements HasTable
{
    use InteractsWithTable;

    /**
     * Menggunakan type hint yang sangat spesifik untuk PHP 8.3 & Filament terbaru
     */
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected static string|UnitEnum|null $navigationGroup = 'Rekap';
    protected static ?string $navigationLabel = 'Rekap Kendaraan';
    protected static ?string $title = 'REKAP KENDARAAN';

    protected string $view = 'filament.pages.vehicle-summary';

    public function table(Table $table): Table
    {
        return $table
            ->query(Vehicle::query())
            ->columns([
                // Mengambil nama dari relasi brand agar tidak tampil JSON
                TextColumn::make('brand.name')
                    ->label('Merk')
                    ->sortable(),

                TextColumn::make('purchase_year')
                    ->label('Tahun Beli')
                    ->sortable(),
            ])
            ->groups([
                // Pengelompokan data berdasarkan Merk
                Group::make('brand.name')
                    ->label('Merk')
                    ->collapsible(),
            ])
            ->defaultGroup('brand.name')
            ->headerActions([
                // Memperbaiki Internal Server Error pada Excel
                ExportAction::make()
                    ->label('Excel')
                    ->exports([
                        ExcelExport::make()
                            ->fromTable()
                            ->withColumns([
                                Column::make('brand.name')->heading('Merk'),
                                Column::make('purchase_year')->heading('Tahun Beli'),
                            ]),
                    ]),
            ]);
    }
}