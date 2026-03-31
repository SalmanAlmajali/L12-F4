<?php

namespace App\Filament\Resources\CostTypes;

use App\Filament\Resources\CostTypes\Pages\CreateCostType;
use App\Filament\Resources\CostTypes\Pages\EditCostType;
use App\Filament\Resources\CostTypes\Pages\ListCostTypes;
use App\Filament\Resources\CostTypes\Schemas\CostTypeForm;
use App\Filament\Resources\CostTypes\Tables\CostTypesTable;
use App\Models\CostType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CostTypeResource extends Resource
{
    protected static ?string $model = CostType::class;

    protected static ?string $label = 'Jenis biaya';
    protected static ?string $pluralLabel = 'Jenis biaya';
    protected static ?string $breadcrumb = 'Jenis biaya';

    protected static string|\UnitEnum|null $navigationGroup = 'Master Data';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyDollar;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return CostTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CostTypesTable::configure($table);
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
            'index' => ListCostTypes::route('/'),
            // 'create' => CreateCostType::route('/create'),
            // 'edit' => EditCostType::route('/{record}/edit'),
        ];
    }
}
