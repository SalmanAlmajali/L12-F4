<?php

namespace App\Exports;

use App\Models\Service;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ControlCardExport implements FromCollection, WithHeadings, WithMapping
{
    protected $vehicle_id, $year;

    public function __construct($vehicle_id, $year) {
        $this->vehicle_id = $vehicle_id;
        $this->year = $year;
    }

   public function collection() {
    return Service::where('vehicle_id', $this->vehicle_id) // Pastikan pakai vehicle_id
        ->whereYear('service_date', $this->year)
        ->with('details.sparePart')
        ->get();
}
    public function headings(): array {
        return ['Tgl Service', 'No Register', 'KM Service', 'Sparepart', 'Qty', 'Price', 'Total'];
    }

    public function map($service): array {
        $rows = [];
        foreach ($service->details as $detail) {
            $rows[] = [
                $service->service_date,
                $service->register_number,
                $service->km_service,
                $detail->sparePart->name,
                $detail->qty,
                $detail->price,
                $detail->total,
            ];
        }
        return $rows;
    }
}