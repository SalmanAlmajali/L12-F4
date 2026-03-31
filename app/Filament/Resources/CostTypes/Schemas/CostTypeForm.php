<?php

namespace App\Filament\Resources\CostTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CostTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Biaya')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
