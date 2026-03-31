<?php

namespace App\Filament\Resources\Citys\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class CityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('city_name')
                    ->label('Kota / Kabupaten')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
