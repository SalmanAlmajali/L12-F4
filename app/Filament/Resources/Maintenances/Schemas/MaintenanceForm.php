<?php

namespace App\Filament\Resources\Maintenances\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;

class MaintenanceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('vehicle_id')
                    ->label('Kendaraan')
                    ->relationship('vehicle', 'license_plate')
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('service_date')
                    ->label('Tgl Service')
                    ->required(),

                TextInput::make('mileage')
                    ->label('KM Service')
                    ->numeric(),

                TextInput::make('cost')
                    ->label('Biaya')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                DatePicker::make('next_service_date')
                    ->label('Tgl Next Service'),

            ]);
    }
}
