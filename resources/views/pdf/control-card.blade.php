<!DOCTYPE html>
<html>
<head>
    <title>Kartu Kendali</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 20px; }
        .header { text-align: center; font-weight: bold; margin-bottom: 20px; line-height: 1.5; }
        .info-table { width: 100%; margin-bottom: 15px; border: none; }
        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .data-table th, .data-table td { border: 1px solid black; padding: 5px; text-align: left; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        hr { border: 1px solid black; }
    </style>
</head>
<body>
    <div class="header">
        PEMERINTAH DAERAH PROVINSI JAWA BARAT<br>
        SEKRETARIAT DAERAH<br>
        <span style="font-weight: normal; font-size: 10px;">Jalan Diponegoro 22 Telp 022-4232448, 4233347, 4230963 Bandung 40115</span>
        <hr>
        KARTU PENGAWASAN PEMELIHARAAN KENDARAAN DINAS<br>
        TAHUN ANGGARAN {{ $year }}
    </div>

    <table class="info-table">
        <tr>
            <td width="15%">Tgl Service</td><td width="35%">: {{ $services->first()->service_date ?? '-' }}</td>
            <td width="15%">No Polisi</td><td width="35%">: {{ $vehicle->license_plate }}</td>
            <td width="15%">No Rangka</td><td>: {{ $vehicle->chassis_number ?? '-' }}</td>
        </tr>
        <tr>
            <td>No Mesin</td><td>: {{ $vehicle->engine_number ?? '-' }}</td>
        </tr>
    </table>

<table class="data-table">
    <thead>
        <tr>
            <th>No</th>
            <th>Tgl Service</th> 
            <th>No Reg</th>
            <th>Sparepart</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $index => $service)
            {{-- Loop untuk detail sparepart di dalam satu service --}}
            @foreach($service->details as $detail)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $service->service_date }}</td> <td>{{ $service->register_number }}</td>
                <td>{{ $detail->sparePart->name }}</td>
                <td class="text-center">{{ $detail->qty }}</td>
                <td class="text-right">{{ number_format($detail->price, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($detail->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
</body>
</html>