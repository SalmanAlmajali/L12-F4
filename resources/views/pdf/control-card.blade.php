<!DOCTYPE html>
<html>
<head>
    <title>Print Kartu Kendali</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; margin: 0; padding: 20px; }
        .text-center { text-align: center; }
        .text-uppercase { text-transform: uppercase; }
        .header-kop { line-height: 1.2; margin-bottom: 20px; border-bottom: 2px solid black; padding-bottom: 5px; }
        
        .info-table { width: 100%; margin-bottom: 10px; }
        .info-table td { vertical-align: top; }

        .data-table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .data-table th, .data-table td { border: 1px solid black; padding: 5px; }
        .data-table th { background-color: #ffffff; }
        
        .footer-total { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header-kop text-center">
        <div style="font-size: 14px; font-weight: bold;">PEMERINTAH DAERAH PROVINSI JAWA BARAT</div>
        <div style="font-size: 14px; font-weight: bold;">SEKRETARIAT DAERAH</div>
        <div>Jalan Diponegoro 22 Telp 022-4232448, 4233347, 4230963</div>
        <div>Fax 022 4203450 Web : www.jabarprov.go.id Email : info@jabarprov.go.id</div>
        <div>BANDUNG 40115</div>
    </div>

    <div class="text-center" style="margin-bottom: 20px;">
        <div style="font-weight: bold; text-decoration: underline;">KARTU PENGAWASAN PEMELIHARAAN KENDARAAN DINAS</div>
        <div class="text-uppercase">OPERATIONAL RODA 4 (EMPAT)</div>
        <div>TAHUN ANGGARAN {{ $year }}</div>
    </div>

    <table class="info-table">
        <tr>
            <td width="15%">No Polisi</td>
            <td width="2%">:</td>
            <td width="33%">{{ $vehicle->license_plate }}</td>
            <td width="15%">No Rangka</td>
            <td width="2%">:</td>
            <td width="33%">{{ $vehicle->frame_number ?? '-' }}</td>
        </tr>
        <tr>
            <td>Type / Merk</td>
            <td>:</td>
            <td>{{ $vehicle->model }}</td>
            <td>No Mesin</td>
            <td>:</td>
            <td>{{ $vehicle->engine_number ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tahun</td>
            <td>:</td>
            <td>{{ $vehicle->purchase_year }}</td>
            <td>Pemegang</td>
            <td>:</td>
            <td>BIRO UMUM</td> </tr>
    </table>

    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="10%">No Reg</th>
                <th width="35%">Sparepart</th>
                <th width="10%">Qty</th>
                <th width="20%">Price</th>
                <th width="20%">Total</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($services as $service)
                @foreach($service->details as $detail)
                <tr>
                    <td class="text-center">{{ $no++ }}</td>
                    <td class="text-center">{{ $service->register_number ?? '-' }}</td>
                    <td>{{ $detail->sparePart->name ?? '-' }}</td>
                    <td class="text-center">{{ $detail->qty }}</td>
                    <td style="text-align: right;">{{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td style="text-align: right;">{{ number_format($detail->total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr class="footer-total">
                <td colspan="5" style="text-align: center;">Total</td>
                <td style="text-align: right;">{{ number_format($services->sum('total_cost'), 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>