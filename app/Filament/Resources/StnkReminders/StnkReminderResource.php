<?php

namespace App\Filament\Resources\StnkReminders;

use App\Filament\Resources\StnkReminders\Pages\ListStnkReminders;
use App\Filament\Resources\StnkReminders\Schemas\StnkReminderForm;
use App\Filament\Resources\StnkReminders\Tables\StnkRemindersTable;
use App\Models\Vehicle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StnkReminderResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationLabel = 'Jadwal Perpanjang STNK';
    protected static ?string $pluralLabel = 'Jadwal Perpanjang STNK';
    protected static ?string $label = 'STNK Reminder';

    protected static string|\UnitEnum|null $navigationGroup = 'Pengingat';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    public static function form(Schema $schema): Schema
    {
        return StnkReminderForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StnkRemindersTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStnkReminders::route('/'),
        ];
    }
}