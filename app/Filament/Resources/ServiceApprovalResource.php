<?php

namespace App\Filament\Resources;


use App\Models\Service;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use App\Filament\Widgets\ServiceStats;
use App\Filament\Resources\ServiceApprovals\Pages;
use Illuminate\Database\Eloquent\Builder;

class ServiceApprovalResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationLabel = 'Persetujuan Service';

    protected static ?string $slug = 'service-approval';

    protected static string|\UnitEnum|null $navigationGroup = 'Nota Dinas';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-check-circle';

   public static function table(Table $table): Table
{
    return $table
        ->columns([
            // 1. No Register
            Tables\Columns\TextColumn::make('register_number')
                ->label('No Register')
                ->searchable()
                ->sortable(),

            // Kolom No Polisi (Relasi dari Vehicle)
            Tables\Columns\TextColumn::make('vehicle.license_plate')
                ->label('No Polisi')
                ->searchable(),
            
            // 2. KM Service
            Tables\Columns\TextColumn::make('km_service')
                ->label('KM Service')
                ->suffix(' KM') // Menambahkan satuan KM di belakang angka
                ->sortable(),

            // Tgl Service (Sekarang)
            Tables\Columns\TextColumn::make('service_date')
                ->label('Tgl Service')
                ->date('d/m/Y'),

            // 3. Tgl Next Service
            Tables\Columns\TextColumn::make('next_service_date')
                ->label('Tgl Next Service')
                ->date('d/m/Y')
                ->color('danger'), // Dibedakan warnanya agar user aware kapan service lagi

            Tables\Columns\TextColumn::make('total_cost')
                ->label('Biaya')
                ->money('IDR'),

                Tables\Columns\CheckboxColumn::make('is_approved')
                ->label('Approve'),
        ])
        ->actions([
        ]);
}
    public static function getWidgets(): array
    {
        return [
            ServiceStats::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServiceApprovals::route('/'),
        ];
    }
}