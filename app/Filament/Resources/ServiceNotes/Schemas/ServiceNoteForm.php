<?php

namespace App\Filament\Resources\ServiceNotes\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Schema;
use App\Models\Vehicle;

class ServiceNoteForm
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


DatePicker::make('date')
    ->label('Tanggal')
    ->required(),

TextInput::make('number')
    ->label('No'),

TextInput::make('cc')
    ->label('Tembusan'),

Textarea::make('introduction')
    ->label('Kata Pengantar')
    ->columnSpanFull(),

TextInput::make('position')
    ->label('Jabatan'),

TextInput::make('name')
    ->label('Nama'),

TextInput::make('nip'),

Toggle::make('approved')
    ->label('Disetujui'),

CheckboxList::make('spareParts')
    ->label('Suku Cadang')
    ->relationship('spareParts', 'name')
    ->columns(2)
            ]);
        }
}
