<?php

use Illuminate\Support\Facades\Route; // Tambahkan ini
use Illuminate\Http\Request;           // Tambahkan ini
use App\Models\Vehicle;
use App\Models\Service;
use App\Exports\ControlCardExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

// Baru setelah itu kodenya...
Route::get('/admin/control-card/print', function (Request $request) {
    $vehicle = Vehicle::findOrFail($request->vehicle_id);
    $services = Service::where('vehicle_id', $request->vehicle_id)
        ->whereYear('service_date', $request->year)
        ->with('details.sparePart')
        ->get();

    $pdf = Pdf::loadView('pdf.control-card', [
        'vehicle' => $vehicle,
        'services' => $services,
        'year' => $request->year
    ])->setPaper('a4', 'portrait');

    return $pdf->stream('PrintKartuKendali.pdf');
})->name('control-card.print');



Route::get('/admin/control-card/excel', function (Request $request) {
    $fileName = 'ControlCard_' . now()->format('Ymd_His') . '.xlsx';
    return Excel::download(new ControlCardExport($request->vehicle_id, $request->year), $fileName);
})->name('control-card.excel');