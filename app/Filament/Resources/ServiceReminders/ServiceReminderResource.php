<?php

namespace App\Filament\Resources\ServiceReminders;

use App\Filament\Resources\ServiceReminders\Pages\ListServiceReminders;
use App\Filament\Resources\ServiceReminders\Tables\ServiceRemindersTable;
use App\Models\Vehicle;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use BackedEnum;

class ServiceReminderResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationLabel = 'Jadwal Service Berkala';
    protected static ?string $pluralLabel = 'Jadwal Service Berkala';
    protected static ?string $label = 'Service Reminder';

    // Perbaikan Type Hinting Group
    protected static string|\UnitEnum|null $navigationGroup = 'Pengingat';

    // Perbaikan Type Hinting Icon
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function canCreate(): bool { return false; }

   public static function table(Table $table): Table
{
    return ServiceRemindersTable::configure($table)
        ->modifyQueryUsing(fn ($query) => $query->with(['maintenances']));
}

    public static function getPages(): array
    {
        return [
            'index' => ListServiceReminders::route('/'),
        ];
    }
}