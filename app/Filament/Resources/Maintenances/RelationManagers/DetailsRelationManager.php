<?php

namespace App\Filament\Resources\Maintenances\RelationManagers;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

// ✅ v4 pakai ini
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;

class DetailsRelationManager extends RelationManager
{
    protected static string $relationship = 'details';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('spare_part_id')
                ->relationship('sparePart', 'name')
                ->required(),

            TextInput::make('qty')
                ->numeric()
                ->required(),

            TextInput::make('price')
                ->numeric()
                ->required(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('sparePart.name')
                    ->label('Spare Part'),

                TextColumn::make('qty'),

                TextColumn::make('price')
                    ->money('IDR'),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
