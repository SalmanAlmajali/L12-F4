<?php

namespace App\Filament\Resources\StnkReminders\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StnkReminderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('license_plate')
                    ->label('No Polisi')
                    ->disabled(),

                TextInput::make('model')
                    ->label('Type')
                    ->disabled(),

                DatePicker::make('stnk_due_date')
                    ->label('Tanggal Perpanjang')
                    ->required(),

                DatePicker::make('stnk_5_year_due_date')
                    ->label('STNK 5 Thn'),
            ])
            ->columns(2); // Menutup statement return dengan titik koma
    }
}