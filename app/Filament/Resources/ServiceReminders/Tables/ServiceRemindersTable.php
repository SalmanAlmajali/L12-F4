<?php

namespace App\Filament\Resources\ServiceReminders\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Vehicle;

class ServiceRemindersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->striped()
            ->recordActions([])
            ->bulkActions([])
            ->columns([
                TextColumn::make('license_plate')
                    ->label('No Polisi')
                    ->searchable(),

                TextColumn::make('model')
                    ->label('Type'),

                TextColumn::make('maintenances.service_date')
                    ->label('Service Terakhir')
                    ->date('d M Y')
                    ->getStateUsing(fn ($record) => $record->maintenances()->latest('service_date')->first()?->service_date)
                    ->placeholder('Belum pernah'),

                TextColumn::make('maintenances.mileage')
                    ->label('KM Service')
                    ->getStateUsing(fn ($record) => $record->maintenances()->latest('service_date')->first()?->mileage)
                    ->placeholder('0'),

                TextColumn::make('maintenances.total_cost')
                    ->label('Biaya')
                    ->money('IDR')
                    ->getStateUsing(fn ($record) => $record->maintenances()->latest('service_date')->first()?->total_cost)
                    ->placeholder('0'),

                TextColumn::make('maintenances.next_service_date')
                    ->label('KM Service Berikutnya')
                    ->weight('bold')
                    ->color('primary')
                    ->getStateUsing(fn ($record) => $record->maintenances()->latest('service_date')->first()?->next_service_date),
            ])
            ->filters([
              
                SelectFilter::make('license_plate')
                    ->label('No Polisi')
                    ->searchable()
                    ->options(fn () => Vehicle::pluck('license_plate', 'license_plate')->toArray()),
            ])
            ->filtersFormColumns(1);
    }
}