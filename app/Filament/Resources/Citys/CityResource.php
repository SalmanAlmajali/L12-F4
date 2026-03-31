<?php

namespace App\Filament\Resources\Citys;

use App\Filament\Resources\Citys\Pages\CreateCity;
use App\Filament\Resources\Citys\Pages\EditCity;
use App\Filament\Resources\Citys\Pages\ListCitys;
use App\Filament\Resources\Citys\Schemas\CityForm;
use App\Filament\Resources\Citys\Tables\CitysTable;
use App\Models\City;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CityResource extends Resource
{
    protected static ?string $model = City::class;

    protected static ?string $navigationLabel = 'Kota / Kab';
    protected static ?string $pluralLabel = 'Kota / Kab';
    protected static ?string $label = 'Kota / Kab';
    protected static ?string $breadcrumb = 'Kota / Kab';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMapPin;

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?string $recordTitleAttribute = 'city_name';

    public static function form(Schema $schema): Schema
    {
        return cityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return citysTable::configure($table);
    }

    public static function getPages(): array
    {
        return [
            'index' => Listcitys::route('/'),
            // 'create' => Createcity::route('/create'),
            // 'edit' => Editcity::route('/{record}/edit'),
        ];
    }
}
