<?php

namespace App\Filament\Resources\CostTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CostTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->emptyStateHeading('Belum ada data jenis biaya')
            ->emptyStateDescription('Silakan tambahkan jenis biaya terlebih dahulu')
            ->columns([
                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),

                TextColumn::make('no')
                    ->label('No.')
                    ->rowIndex(),

                TextColumn::make('name')
                    ->label('Biaya')
                    ->searchable(),
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
                EditAction::make()
                    ->modalWidth('md'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
