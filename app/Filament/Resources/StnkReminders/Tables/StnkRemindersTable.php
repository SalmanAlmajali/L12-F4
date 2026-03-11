<?php

namespace App\Filament\Resources\StnkReminders\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Filters\SelectFilter;

class StnkRemindersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            // 1. Menghilangkan Header Actions (Tombol Buat)
            ->headerActions([]) 
            ->actions([]) 
            ->bulkActions([])
            
            // 2. Definisi Kolom Lengkap
            ->columns([
                TextColumn::make('vehicleType.name')->label('Jenis')->searchable(),
                TextColumn::make('brand.name')->label('Merk')->searchable(),
                TextColumn::make('license_plate')->label('No Polisi')->searchable(),
                TextColumn::make('model')->label('Type'),
                TextColumn::make('chassis_number')->label('No Rangka')->toggleable(),
                TextColumn::make('engine_number')->label('No Mesin')->toggleable(),
                TextColumn::make('purchase_year')->label('Tahun'),
                TextColumn::make('color')->label('Warna'),
                
                TextColumn::make('stnk_due_date')
                    ->label('Perpanjang')
                    ->date('d M Y')
                    ->color('danger')
                    ->weight('bold')
                    ->sortable(),

                TextColumn::make('stnk_5_year_due_date')->label('STNK 5 thn')->date('d M Y'),
                TextColumn::make('directorate.name')->label('Unit Pemakai'),
                TextColumn::make('position.name')->label('Posisi'),
                CheckboxColumn::make('is_active')->label('Active')->disabled(),
            ])

            // 3. Membuat Filter seperti di Foto (Pop-up Filter)
            ->filters([               
                // Filter No Polisi (Pilih salah satu opsi)
                SelectFilter::make('license_plate')
                    ->label('No Polisi')
                    ->searchable()
                    ->options(fn () => \App\Models\Vehicle::pluck('license_plate', 'license_plate')->toArray()),
            ])
            // Mengatur agar filter muncul di pop-up kanan atas (icon corong)
            ->filtersFormColumns(1);
    }
}