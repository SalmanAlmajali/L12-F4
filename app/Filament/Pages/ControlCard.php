<?php

namespace App\Filament\Pages;

use App\Models\Vehicle;
use App\Models\Service;
use Filament\Pages\Page;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Actions\Action; // Pastikan baris ini ada di paling atas

class ControlCard extends Page implements HasSchemas, HasTable
{
    use InteractsWithSchemas;
    use InteractsWithTable;

    protected static ?string $title = 'Kartu Kendali';
    protected static string|\UnitEnum|null $navigationGroup = 'Service';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected string $view = 'filament.pages.control-card';

    public ?array $data = [];

    public function submit(): void
{
    // Kosongkan saja, karena wire:model.live sudah otomatis mengupdate tabel
}

    public function mount(): void
    {
        $this->form->fill();
    }

public function form(Schema $schema): Schema
{
    return $schema
        ->statePath('data')
        ->schema([
            \Filament\Schemas\Components\Fieldset::make('Filter')
                ->schema([
                    \Filament\Schemas\Components\Grid::make(2)
                        ->schema([
                            \Filament\Schemas\Components\Html::make('
                                <div class="space-y-2">
                                    <label class="text-sm font-bold flex">No Polisi <span class="text-danger-600">*</span></label>
                                    <select wire:model.live="data.vehicle_id" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                                        <option value="">Pilih Kendaraan</option>
                                        ' . collect(\App\Models\Vehicle::all())->map(fn($v) => "<option value='{$v->id}'>{$v->license_plate}</option>")->implode('') . '
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-bold flex">Tahun <span class="text-danger-600">*</span></label>
                                    <select wire:model.live="data.year" class="block w-full border-gray-300 rounded-lg shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white">
                                        <option value="">Pilih Tahun</option>
                                        ' . collect(range(date('Y'), 2020))->map(fn($y) => "<option value='{$y}'>{$y}</option>")->implode('') . '
                                    </select>
                                </div>
                            '),
                        ]),
                   
                ])
        ]);
}

  public function table(Table $table): Table
{
    return $table
        ->query(
            Service::query()
                ->with(['details.sparePart'])
                ->when(data_get($this->data, 'vehicle_id'), fn ($q, $v) => $q->where('vehicle_id', $v))
                ->when(data_get($this->data, 'year'), fn ($q, $y) => $q->whereYear('service_date', $y))
                ->when(!data_get($this->data, 'vehicle_id') || !data_get($this->data, 'year'), fn ($q) => $q->whereRaw('1 = 0'))
        )
        ->columns([
            TextColumn::make('service_date')->label('Tgl Service')->date('d M Y'),
            TextColumn::make('register_number')->label('No Register'), // Tambahan kolom
            TextColumn::make('km_service')->label('KM Service')->numeric(thousandsSeparator: '.'),
            TextColumn::make('details.sparePart.name')->label('Spare Part')->listWithLineBreaks()->bulleted(),
            TextColumn::make('details.price')->label('Price')->money('IDR', locale: 'id'), // Tambahan kolom
            TextColumn::make('details.qty')->label('Qty'), // Tambahan kolom
            TextColumn::make('details.total')->label('Total')->money('IDR', locale: 'id')
                ->summarize(\Filament\Tables\Columns\Summarizers\Sum::make()->label('Grand Total')),
        ])
       
      ->headerActions([
    Action::make('exportExcel') // Cukup tulis Action::make karena sudah ada 'use' di atas
        ->label('Excel')
        ->icon('heroicon-s-document-arrow-down')
        ->color('success')
        ->url(fn() => route('control-card.excel', [
            'vehicle_id' => data_get($this->data, 'vehicle_id'),
            'year' => data_get($this->data, 'year')
        ]))
        ->openUrlInNewTab(),

    Action::make('print')
        ->label('Print')
        ->icon('heroicon-s-printer')
        ->color('gray')
        ->url(fn() => route('control-card.print', [
            'vehicle_id' => data_get($this->data, 'vehicle_id'),
            'year' => data_get($this->data, 'year')
        ]))
        ->openUrlInNewTab(),
        ]);
}
}