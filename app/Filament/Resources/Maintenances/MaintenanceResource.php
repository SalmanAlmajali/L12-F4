<?php

namespace App\Filament\Resources\Maintenances;

use App\Filament\Resources\Maintenances\Pages\CreateMaintenance;
use App\Filament\Resources\Maintenances\Pages\EditMaintenance;
use App\Filament\Resources\Maintenances\Pages\ListMaintenances;
use App\Filament\Resources\Maintenances\Schemas\MaintenanceForm;
use App\Filament\Resources\Maintenances\Tables\MaintenancesTable;
use App\Models\Maintenance;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MaintenanceResource extends Resource
{
    protected static ?string $model = Maintenance::class;

    protected static ?string $navigationLabel = 'Lihat Data';
    protected static ?string $pluralLabel = 'Lihat Data';
    protected static ?string $label = 'Lihat Data';
    protected static ?string $breadcrumb = 'Lihat Data';

        protected static string|\UnitEnum|null $navigationGroup = 'Service';


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEye;

    public static function form(Schema $schema): Schema
    {
        return MaintenanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MaintenancesTable::configure($table);
    }

    public static function getRelations(): array
{
    return [
        RelationManagers\DetailsRelationManager::class,
    ];
}


    public static function getPages(): array
{
    return [
        'index' => Pages\ListMaintenances::route('/'),
        'view' => Pages\ViewMaintenance::route('/{record}'),
    ];
}

public static function canCreate(): bool
{
    return false;
}

public static function canEdit($record): bool
{
    return false;
}

public static function canDelete($record): bool
{
    return false;
}

}
