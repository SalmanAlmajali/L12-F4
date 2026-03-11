<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
              TextColumn::make('vehicle.license_plate')
                  ->label('No Polisi')
                  ->searchable(),
                TextColumn::make('service_date')
                    ->label('Tgl Service')
                    ->date()
                    ->sortable(),
                TextColumn::make('register_number')
                    ->label('No Register')
                    ->searchable(),
                TextColumn::make('km_service')
                    ->numeric(),
                    TextColumn::make('total_cost')
                    ->label('Biaya')
                    ->money('IDR')
                    ->sortable(),
                TextColumn::make('next_service_date')
                    ->label('Tgl Next Service')
                    ->date()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
