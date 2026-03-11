<?php

namespace App\Filament\Resources\Services\Schemas;

use App\Models\SparePart;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use App\Models\Vehicle;
use Filament\Schemas\Schema;


class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

               Select::make('vehicle_id')
    ->label('Kendaraan')
    ->options(
        Vehicle::pluck('license_plate', 'id')
    )
    ->searchable()
    ->preload()
    ->required(),

                DatePicker::make('service_date')
                    ->label('Tgl Service')
                    ->required(),

                      TextInput::make('register_number')
                    ->label('No Register')
                    ->required(),

                TextInput::make('km_service')
                    ->required(),

                DatePicker::make('next_service_date')
                    ->label('Tgl Next Service')
                    ->required(),

                Textarea::make('memo')
                    ->columnSpanFull(),

                Repeater::make('details')
                    ->relationship()
                    ->schema([

                        Select::make('spare_part_id')
                            ->label('Suku Cadang')
                            ->options(SparePart::all()->pluck('name', 'id'))
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                $sparePart = SparePart::find($state);
                                $set('price', $sparePart?->price ?? 0);
                                $set('subtotal', $sparePart?->price ?? 0);
                            })
                            ->required(),

                        TextInput::make('price')
                            ->label('Harga')
                            ->numeric()
                            ->readonly()
                            ->required(),

                        TextInput::make('qty')
                            ->label('Jumlah')
                            ->numeric()
                            ->default(1)
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $price = $get('price') ?? 0;
                                $set('subtotal', $price * $state);
                            })
                            ->required(),

                        TextInput::make('subtotal')
                            ->numeric()
                            ->readonly()
                            ->required(),

                    ])
                    ->columns(4)
                    ->columnSpanFull(),

                TextInput::make('total_cost')
                    ->label('Biaya')
                    ->numeric()
                    ->readonly()
                    ->required()
                    ->default(0),
            ]);
    }
}