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
                    ->options(Vehicle::pluck('license_plate', 'id'))
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
                    ->label('KM Service')
                    ->numeric()
                    ->required(),

                DatePicker::make('next_service_date')
                    ->label('Tgl Next Service')
                    ->required(),

                Textarea::make('memo')
                    ->label('Memo')
                    ->columnSpanFull(),

                Repeater::make('details')
                    ->relationship()
                    ->label('Rincian Suku Cadang')
                    ->schema([
                        Select::make('spare_part_id')
                            ->label('Suku Cadang')
                            ->options(SparePart::all()->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                $sparePart = SparePart::find($state);
                                $price = $sparePart?->price ?? 0;
                                $qty = (float) ($get('qty') ?? 1);
                                
                                $set('price', $price);
                                $set('total', $price * $qty);
                            })
                            ->columnSpan(2),

                        TextInput::make('price')
                            ->label('Harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->readonly()
                            ->required(),

                        TextInput::make('qty')
                            ->label('Jumlah')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $price = (float) ($get('price') ?? 0);
                                $set('total', $price * (float) $state);
                            }),

                        TextInput::make('total')
                            ->label('Subtotal')
                            ->numeric()
                            ->prefix('Rp')
                            ->readonly()
                            ->required(),
                    ])
                    ->columns(5)
                    ->columnSpanFull()
                    ->reactive()
                    // INI KUNCI PERBAIKANNYA: Paksa hitung ulang total_cost
                    ->afterStateUpdated(function (callable $set, callable $get) {
                        $details = $get('details') ?? [];
                        $totalBiaya = 0;

                        foreach ($details as $item) {
                            $totalBiaya += (float) ($item['total'] ?? 0);
                        }
                        
                        $set('total_cost', $totalBiaya);
                    }),

                TextInput::make('total_cost')
                    ->label('Total Biaya')
                    ->numeric()
                    ->prefix('Rp')
                    ->readonly()
                    ->required()
                    ->dehydrated() // Pastikan nilai terkirim ke database
                    ->extraInputAttributes(['style' => 'font-weight: bold; color: #fbbf24;']),
            ]);
    }
}