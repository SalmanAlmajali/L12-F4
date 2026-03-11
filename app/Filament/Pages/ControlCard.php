<?php

namespace App\Filament\Pages;

use App\Models\Vehicle;
use App\Models\Service; // Tambahkan ini
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\Action;

class ControlCard extends Page implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    protected static ?string $title = 'Kartu Kendali';
    protected static string|\UnitEnum|null $navigationGroup = 'Service';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-text';
    protected string $view = 'filament.pages.control-card';

    // Properti ini yang akan menangkap inputan user
    public ?int $year = null;
    public ?int $vehicle_id = null;

    // Tambahkan di dalam class ControlCard
public function submit(): void
{
    // Memaksa Livewire untuk merender ulang komponen tabel
    $this->dispatch('refreshTable'); 
}

    // Tambahkan properti ini di bagian atas class
public ?array $data = []; 

public function mount(): void
{
    // Inisialisasi form dengan array data
    $this->form->fill();
}

public function form(Schema $schema): Schema
{
    return $schema
        ->statePath('data') // Menghubungkan input ke array $this->data
        ->components([
            Select::make('vehicle_id')
                ->label('No Polisi')
                ->options(Vehicle::pluck('license_plate', 'id'))
                ->searchable()
                ->required(),

            Select::make('year')
                ->label('Tahun')
                ->options(collect(range(date('Y'), 2020))->mapWithKeys(fn ($y) => [$y => $y])->toArray())
                ->required(),
        ]);
}

public function table(Table $table): Table
{
    return $table
        ->query(
            Service::query()
                ->with(['details.sparePart'])
                // Ambil nilai dari array data
                ->when($this->data['vehicle_id'] ?? null, fn ($q, $v) => $q->where('vehicle_id', $v))
                ->when($this->data['year'] ?? null, fn ($q, $y) => $q->whereYear('service_date', $y))
                // Sembunyikan jika belum ada input (sesuai revisi pembimbing)
                ->when(!($this->data['vehicle_id'] ?? null) || !($this->data['year'] ?? null), fn ($q) => $q->whereRaw('1 = 0'))
        )
        ->columns([
            TextColumn::make('service_date')
                ->label('Tgl Service')
                ->date('d M Y'),

            TextColumn::make('register_number')
                ->label('No Register')
                ->default('-'),

            TextColumn::make('km_service')
                ->label('KM Service')
                ->numeric(thousandsSeparator: '.'),

            TextColumn::make('details.sparePart.name') 
                ->label('Spare Part')
                ->listWithLineBreaks()
                ->bulleted(),

            TextColumn::make('details.price')
                ->label('Price')
                ->money('IDR', locale: 'id')
                ->listWithLineBreaks(),

            TextColumn::make('details.qty')
                ->label('Qty')
                ->listWithLineBreaks(),

            TextColumn::make('details.total')
                ->label('Total')
                ->money('IDR', locale: 'id')
                ->listWithLineBreaks()
                ->summarize(\Filament\Tables\Columns\Summarizers\Sum::make()->label('Grand Total')),
        ]) // DI SINI: Tanda titik koma dihapus
        ->headerActions([
            Action::make('exportExcel')
                ->label('Excel')
                ->icon('heroicon-o-document-arrow-down')
                ->color('success')
                ->action(fn() => $this->dispatch('export-excel')),

            Action::make('printPdf')
                ->label('Print')
                ->icon('heroicon-o-printer')
                ->color('gray')
                ->url(fn () => route('control-card.pdf', [
                    'vehicle_id' => $this->vehicle_id,
                    'year' => $this->year,
                ]))
                ->openUrlInNewTab(),
        ]); // Titik koma dipindah ke sini
}
}