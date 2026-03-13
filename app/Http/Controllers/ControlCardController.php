<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ControlCardExport; // Pastikan ini dibuat nanti

class ControlCardController extends Controller
{
    public function downloadPdf(Request $request)
    {
        $vehicleId = $request->query('vehicle_id');
        $year = $request->query('year');

        // Validasi jika data kosong
        if (!$vehicleId || !$year) {
            abort(404, 'Data tidak lengkap');
        }

        $vehicle = Vehicle::findOrFail($vehicleId);
        $services = Service::where('vehicle_id', $vehicleId)
            ->whereYear('service_date', $year)
            ->with(['details.sparePart'])
            ->get();

        $pdf = Pdf::loadView('pdf.control-card', [
            'vehicle' => $vehicle,
            'services' => $services,
            'year' => $year,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('Kartu_Kendali_' . $vehicle->license_plate . '.pdf');
    }

    public function downloadExcel(Request $request)
    {
        $vehicleId = $request->query('vehicle_id');
        $year = $request->query('year');

        if (!$vehicleId || !$year) {
            abort(404, 'Data tidak lengkap');
        }

        $vehicle = Vehicle::find($vehicleId);
        $fileName = 'Kartu_Kendali_' . ($vehicle->license_plate ?? 'Export') . '.xlsx';

        // Mengirim data ke class Export
        return Excel::download(new ControlCardExport($vehicleId, $year), $fileName);
    }
}