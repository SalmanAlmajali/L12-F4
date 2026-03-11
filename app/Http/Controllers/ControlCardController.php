<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ControlCardController extends Controller
{
    public function downloadPdf(Request $request)
    {
        $vehicleId = $request->query('vehicle_id');
        $year = $request->query('year');

        $vehicle = Vehicle::findOrFail($vehicleId);
        $services = Service::where('vehicle_id', $vehicleId)
            ->whereYear('service_date', $year)
            ->get();

        $pdf = Pdf::loadView('pdf.control-card', [
            'vehicle' => $vehicle,
            'services' => $services,
            'year' => $year,
        ])->setPaper('a4', 'landscape'); // Landscape agar mirip referensi pembimbing

        return $pdf->stream('Kartu_Kendali_' . $vehicle->license_plate . '.pdf');
    }
}