<?php

namespace App\Filament\Resources\Vehicles;

use App\Filament\Resources\Vehicles\Pages\CreateVehicle;
use App\Filament\Resources\Vehicles\Pages\EditVehicle;
use App\Filament\Resources\Vehicles\Pages\ListVehicles;
use App\Filament\Resources\Vehicles\Schemas\VehicleForm;
use App\Filament\Resources\Vehicles\Tables\VehiclesTable;
use App\Models\Vehicle;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;



class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationLabel = 'Admin Kendaraan';
    protected static ?string $pluralLabel = 'Admin Kendaraan';
    protected static ?string $label = 'Admin Kendaraan';
    protected static ?string $breadcrumb = ' Admin Kendaraan';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTruck;
        protected static string|\UnitEnum|null $navigationGroup = 'Kendaraan';


    /** URUTAN MENU */
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return VehicleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VehiclesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListVehicles::route('/'),
            'create' => CreateVehicle::route('/create'),
            'edit'   => EditVehicle::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->where('is_deleted', false);
}

}
