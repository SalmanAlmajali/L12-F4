<?php

namespace App\Filament\Resources\Maintenances;

use App\Filament\Resources\Maintenances\Pages\ListMaintenances;
use App\Filament\Resources\Maintenances\Pages\ViewMaintenance;
use App\Filament\Resources\Maintenances\Schemas\MaintenanceForm;
use App\Filament\Resources\Maintenances\Tables\MaintenancesTable;
use App\Models\Service; // [REVISI] Menggunakan model Service sesuai instruksi
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MaintenanceResource extends Resource
{
    // [REVISI] Model utama diganti dari Maintenance ke Service
    protected static ?string $model = Service::class;

    // [REVISI] Slug diubah agar URL-nya tidak lagi /maintenances tapi /lihat-data
    protected static ?string $slug = 'lihat-data';

    protected static ?string $navigationLabel = 'Lihat Data';
    protected static ?string $pluralLabel = 'Lihat Data';
    protected static ?string $label = 'Lihat Data';
    protected static ?string $breadcrumb = 'Lihat Data';

    protected static string|\UnitEnum|null $navigationGroup = 'Service';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedEye;

    public static function form(Schema $schema): Schema
    {
        // Tetap menggunakan schema yang ada, namun pastikan field di dalamnya
        // sudah sesuai dengan kolom yang ada di tabel services
        return MaintenanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        // [REVISI] Menambahkan filter agar hanya data yang sudah di-approve yang muncul di Lihat Data
        return MaintenancesTable::configure($table)
            ->modifyQueryUsing(fn (Builder $query) => $query->where('is_approved', true));
    }

    public static function getRelations(): array
    {
        return [
            // Relation manager tetap bisa digunakan jika strukturnya mirip
            // RelationManagers\DetailsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMaintenances::route('/'),
            'view' => ViewMaintenance::route('/{record}'),
        ];
    }

    // Fitur Create, Edit, dan Delete dimatikan karena halaman ini hanya untuk monitoring (Lihat Data)
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