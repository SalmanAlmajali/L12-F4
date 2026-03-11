<?php

namespace App\Filament\Pages;

use App\Models\GpsLog;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class GpsLogData extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $title = 'Data GPS IN';
    protected static string|\UnitEnum|null $navigationGroup = 'Pelacakan';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-map';
    protected string $view = 'filament.pages.gps-log-data';

    public function table(Table $table): Table
    {
        return $table
            ->query(GpsLog::query()->orderBy('logged_at', 'desc'))
            ->columns([
                TextColumn::make('license_plate')
                    ->label('No Polisi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('logged_at')
                    ->label('Date Log')
                    ->dateTime('d/m/Y H:i:s')
                    ->sortable(),
                TextColumn::make('latitude')
                    ->label('Lat'),
                TextColumn::make('longitude')
                    ->label('Long'),
            ])
            ->filters([
                Filter::make('logged_at')
                    ->form([
                        DatePicker::make('logged_from')->label('Dari Tanggal'),
                        DatePicker::make('logged_until')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['logged_from'], fn ($q) => $q->whereDate('logged_at', '>=', $data['logged_from']))
                            ->when($data['logged_until'], fn ($q) => $q->whereDate('logged_at', '<=', $data['logged_until']));
                    })
            ])
            ->actions([])
            ->bulkActions([]);
    }
}