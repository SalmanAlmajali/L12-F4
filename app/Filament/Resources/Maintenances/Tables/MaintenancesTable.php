<?php

namespace App\Filament\Resources\Maintenances\Tables;

use Filament\Tables\Table;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\Summarizers\Sum;

class MaintenancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('vehicle.license_plate')
                    ->label('No Polisi')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('service_date')
                    ->label('Tgl Service')
                    ->date()
                    ->sortable(),

                TextColumn::make('km_service')
                    ->label('KM Service')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('total_cost')
                    ->label('Biaya')
                    ->money('IDR')
                    ->sortable()
                    ->summarize(
                        Sum::make()
                            ->label('Total Biaya')
                            ->money('IDR')
                    ),

                TextColumn::make('next_service_date')
                    ->label('Tgl Next Service')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Filter::make('filter')
                    ->form([
                        DatePicker::make('from_date')->label('Dari Tanggal'),
                        DatePicker::make('until_date')->label('Sampai Tanggal'),
                        DatePicker::make('next_service_date')->label('Next Service'),
                        Select::make('vehicle_id')
                            ->label('No Polisi')
                            ->relationship('vehicle', 'license_plate')
                            ->searchable()
                            ->preload(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from_date'] ?? null, fn ($q, $date) => $q->whereDate('service_date', '>=', $date))
                            ->when($data['until_date'] ?? null, fn ($q, $date) => $q->whereDate('service_date', '<=', $date))
                            ->when($data['next_service_date'] ?? null, fn ($q, $date) => $q->whereDate('next_service_date', $date))
                            ->when($data['vehicle_id'] ?? null, fn ($q, $vehicle) => $q->where('vehicle_id', $vehicle));
                    }),
            ])
            // Kosongkan dulu untuk memastikan tabel jalan
            ->actions([])
            ->recordActions([]);
    }
}