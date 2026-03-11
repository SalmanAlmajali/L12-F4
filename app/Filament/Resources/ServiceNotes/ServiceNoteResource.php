<?php

namespace App\Filament\Resources\ServiceNotes;

use App\Filament\Resources\ServiceNotes\Pages\CreateServiceNote;
use App\Filament\Resources\ServiceNotes\Pages\EditServiceNote;
use App\Filament\Resources\ServiceNotes\Pages\ListServiceNotes;
use App\Filament\Resources\ServiceNotes\Schemas\ServiceNoteForm;
use App\Filament\Resources\ServiceNotes\Tables\ServiceNotesTable;
use App\Models\ServiceNote;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ServiceNoteResource extends Resource
{
    protected static ?string $model = ServiceNote::class;

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
        return ServiceNotesTable::configure($table);
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
            'index' => ListServiceNotes::route('/'),
            'create' => CreateServiceNote::route('/create'),
            'edit' => EditServiceNote::route('/{record}/edit'),
        ];
    }
}
