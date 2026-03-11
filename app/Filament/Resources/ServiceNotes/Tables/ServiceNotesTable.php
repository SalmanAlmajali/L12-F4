<?php

namespace App\Filament\Resources\ServiceNotes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServiceNotesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('vehicle.license_plate')
    ->label('No Polisi')
    ->sortable()
    ->searchable(),

TextColumn::make('date')
    ->label('Tanggal')
    ->date()
    ->sortable(),

TextColumn::make('number')
    ->label('No')
    ->searchable(),

TextColumn::make('name')
    ->label('Nama')
    ->searchable(),

IconColumn::make('approved')
    ->boolean()
    ->label('Disetujui'),

            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
