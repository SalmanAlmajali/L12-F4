<?php

namespace App\Filament\Resources\ServiceNotes;

use App\Filament\Resources\ServiceNotes\Pages\CreateServiceNote;
use App\Filament\Resources\ServiceNotes\Pages\EditServiceNote;
use App\Filament\Resources\ServiceNotes\Pages\ListServiceNotes;
use App\Filament\Resources\ServiceNotes\Schemas\ServiceNoteForm;
use App\Filament\Resources\ServiceNotes\Tables\ServiceNotesTable;
use App\Models\Service; // [REVISI] Ubah ke model Service
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Navigation\NavigationItem;
use Illuminate\Database\Eloquent\Builder; // Tambahkan ini untuk filter

class ServiceNoteResource extends Resource
{
    // [REVISI] Model utama sekarang adalah Service
    protected static ?string $model = Service::class;

    protected static ?string $navigationLabel = 'Nota Dinas';
    protected static ?string $pluralLabel = 'Nota Dinas';
    protected static ?string $label = 'Nota Dinas';
    protected static ?string $breadcrumb = 'Nota Dinas';

    protected static string|\UnitEnum|null $navigationGroup = 'Service';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function form(Schema $schema): Schema
    {
        return ServiceNoteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceNotesTable::configure($table)
            // [REVISI] Tambahkan filter agar hanya menampilkan data Nota Dinas
            ->modifyQueryUsing(fn (Builder $query) => $query->where('is_service_note', true));
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    // [REVISI] Sesuai revisi, kita rapikan navigasi agar tidak double
    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make('Nota Dinas')
                ->group('Service') // Samakan dengan navigationGroup di atas
                ->icon('heroicon-o-clipboard-document-list')
                ->activeIcon('heroicon-s-clipboard-document-list')
                ->url(static::getUrl())
                ->sort(1),
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceNotes::route('/'),
            'create' => CreateServiceNote::route('/create'),
            'edit' => EditServiceNote::route('/{record}/edit'),
        ];
    }
}