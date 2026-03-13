<?php

namespace App\Filament\Resources\ServiceNotes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Schema;
use App\Models\Vehicle;

class ServiceNoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Penanda otomatis bahwa ini adalah Nota Dinas
                Hidden::make('is_service_note')
                    ->default(true),

                Select::make('vehicle_id')
                    ->label('Kendaraan')
                    ->options(Vehicle::pluck('license_plate', 'id'))
                    ->searchable()
                    ->preload()
                    ->required(),

                DatePicker::make('service_date')
                    ->label('Tanggal')
                    ->required(),

                TextInput::make('number')
                    ->label('Nomor'),

                TextInput::make('cc')
                    ->label('Tembusan'),

                Textarea::make('introduction')
                    ->label('Kata Pengantar')
                    ->columnSpanFull(),

                TextInput::make('position')
                    ->label('Jabatan'),

                TextInput::make('name')
                    ->label('Nama'),

                TextInput::make('nip')
                    ->label('NIP'),

                // Repeater Suku Cadang: Hanya pilih nama, tapi kirim 0 ke database agar tidak error
                Repeater::make('details')
                    ->relationship()
                    ->label('Suku Cadang')
                    ->schema([
                        Select::make('spare_part_id')
                            ->label('Spare Part')
                            ->relationship('sparePart', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->columnSpanFull(),

                        Hidden::make('price')
                            ->default(0),
                        Hidden::make('qty')
                            ->default(1),
                        Hidden::make('total')
                            ->default(0),
                    ])
                    ->itemLabel(fn (array $state): ?string => $state['spare_part_id'] ?? null)
                    ->addActionLabel('Tambahkan ke suku cadang')
                    ->columnSpanFull(),
            ]);
    }
}