<?php

namespace App\Filament\Resources\Directorates\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DirectoratesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada data direktorat')
            ->columns([
                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),
                    
                TextColumn::make('name')
                    ->label('Direktorat')
                    ->searchable(),

                TextColumn::make('city.city_name')
                    ->label('Kota/Kab')
                    ->searchable()
                    ->placeholder('-'),

                TextColumn::make('phone_number_1')
                    ->label('Nomor Telepon 1'),

                TextColumn::make('phone_number_2')
                    ->label('Nomor Telepon 2'),

                TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Diupdate')
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
