<x-filament::page>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@400;600;700;800&family=Barlow:wght@300;400;500&display=swap');

    .svc-wrapper {
        font-family: 'Barlow', sans-serif;
        --orange: #FF6B00;
        --orange-dim: #CC5500;
        --orange-glow: rgba(255, 107, 0, 0.15);
        --bg-deep: #0A0A0A;
        --bg-card: #111111;
        --bg-row: #141414;
        --bg-hover: #1A1A1A;
        --border: #222222;
        --border-accent: #FF6B00;
        --text-primary: #F5F5F5;
        --text-secondary: #888888;
        --text-muted: #444444;
    }

    .svc-header {
        font-family: 'Barlow Condensed', sans-serif;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 28px;
    }

    .svc-header-icon {
        width: 48px;
        height: 48px;
        background: var(--orange);
        clip-path: polygon(0 0, 90% 0, 100% 10%, 100% 100%, 10% 100%, 0 90%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .svc-header-icon svg {
        width: 24px;
        height: 24px;
        color: #000;
    }

    .svc-header-title {
        font-size: 28px;
        font-weight: 800;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        color: var(--text-primary);
        line-height: 1;
    }

    .svc-header-title span {
        color: var(--orange);
    }

    .svc-header-sub {
        font-size: 12px;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--text-secondary);
        margin-top: 4px;
    }

    .svc-table-wrap {
        border: 1px solid var(--border);
        border-top: 3px solid var(--orange);
        border-radius: 4px;
        overflow: hidden;
        background: var(--bg-card);
        box-shadow: 0 0 40px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,107,0,0.05);
    }

    .svc-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    /* THEAD */
    .svc-table thead tr {
        background: #0D0D0D;
    }

    .svc-table thead th {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--orange);
        padding: 14px 20px;
        text-align: left;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    .svc-table thead th.right {
        text-align: right;
    }

    .svc-table thead th.center {
        text-align: center;
    }

    /* SERVICE ROWS */
    .svc-row-main {
        background: var(--bg-row);
        border-bottom: 1px solid var(--border);
        transition: background 0.15s;
    }

    .svc-row-main:hover {
        background: var(--bg-hover);
    }

    .svc-row-main td {
        padding: 16px 20px;
        color: var(--text-secondary);
        vertical-align: middle;
    }

    .svc-license {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 0.1em;
        color: var(--text-primary) !important;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .svc-license::before {
        content: '';
        width: 3px;
        height: 18px;
        background: var(--orange);
        border-radius: 2px;
        flex-shrink: 0;
    }

    .svc-reg {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 12px;
        letter-spacing: 0.1em;
        color: var(--text-muted) !important;
        background: #1A1A1A;
        border: 1px solid var(--border);
        padding: 3px 8px;
        border-radius: 2px;
        display: inline-block;
    }

    .svc-km {
        text-align: right;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: var(--text-primary) !important;
    }

    .svc-cost {
        text-align: right;
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 15px;
        font-weight: 700;
        color: var(--orange) !important;
    }

    .svc-date-next {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--text-muted) !important;
    }

    .svc-date-next-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--orange);
        opacity: 0.5;
    }

    .svc-approve-cell {
        text-align: center;
    }

    /* Custom checkbox */
    .svc-cb-wrap {
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .svc-cb {
        appearance: none;
        -webkit-appearance: none;
        width: 18px;
        height: 18px;
        border: 2px solid #333;
        background: #0A0A0A;
        cursor: pointer;
        position: relative;
        transition: border-color 0.2s, background 0.2s;
        clip-path: polygon(0 0, 85% 0, 100% 15%, 100% 100%, 15% 100%, 0 85%);
    }

    .svc-cb:checked {
        border-color: var(--orange);
        background: var(--orange);
    }

    .svc-cb:checked::after {
        content: '';
        position: absolute;
        top: 2px;
        left: 5px;
        width: 5px;
        height: 9px;
        border: 2px solid #000;
        border-top: none;
        border-left: none;
        transform: rotate(45deg);
    }

    .svc-cb:hover {
        border-color: var(--orange-dim);
    }

    /* DETAIL ROW */
    .svc-row-detail {
        background: #0C0C0C;
        border-bottom: 1px solid var(--border);
    }

    .svc-row-detail td {
        padding: 0 20px 16px 36px;
    }

    .svc-detail-table-wrap {
        border: 1px solid #1E1E1E;
        border-left: 2px solid #2A2A2A;
        border-radius: 2px;
        overflow: hidden;
    }

    .svc-detail-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px;
    }

    .svc-detail-table thead tr {
        background: #111;
    }

    .svc-detail-table thead th {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: #444;
        padding: 8px 16px;
        text-align: left;
        border-bottom: 1px solid #1A1A1A;
    }

    .svc-detail-table thead th.right {
        text-align: right;
    }

    .svc-detail-table tbody tr {
        border-bottom: 1px solid #161616;
        transition: background 0.15s;
    }

    .svc-detail-table tbody tr:last-child {
        border-bottom: none;
    }

    .svc-detail-table tbody tr:hover {
        background: #141414;
    }

    .svc-detail-table tbody td {
        padding: 8px 16px;
        color: #666;
    }

    .svc-part-name {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .svc-part-name::before {
        content: '//';
        color: var(--orange);
        opacity: 0.4;
        font-family: 'Barlow Condensed', monospace;
        font-size: 10px;
    }

    .svc-part-approve {
        text-align: right;
    }

    /* Stats bar */
    .svc-stats {
        display: flex;
        gap: 1px;
        margin-bottom: 20px;
    }

    .svc-stat {
        flex: 1;
        background: var(--bg-card);
        border: 1px solid var(--border);
        padding: 14px 18px;
        position: relative;
        overflow: hidden;
    }

    .svc-stat:first-child {
        border-left: 3px solid var(--orange);
        border-radius: 4px 0 0 4px;
    }

    .svc-stat:last-child {
        border-radius: 0 4px 4px 0;
    }

    .svc-stat-label {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 10px;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--text-muted);
    }

    .svc-stat-value {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 22px;
        font-weight: 700;
        color: var(--text-primary);
        margin-top: 2px;
    }

    .svc-stat-value.accent {
        color: var(--orange);
    }

    .svc-stat::after {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 40px;
        height: 100%;
        background: linear-gradient(to left, rgba(255,107,0,0.03), transparent);
    }

    /* Row index badge */
    .svc-idx {
        font-family: 'Barlow Condensed', sans-serif;
        font-size: 10px;
        color: var(--text-muted);
        margin-bottom: 4px;
    }
</style>

<div class="svc-wrapper">

    {{-- HEADER --}}
    <div class="svc-header">
        <div class="svc-header-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
            </svg>
        </div>
        <div>
            <div class="svc-header-title">Data <span>Service</span> Kendaraan</div>
            <div class="svc-header-sub">Manajemen &amp; Persetujuan Servis</div>
        </div>
    </div>

    {{-- STATS --}}
    @php
        $services = \App\Models\Service::with(['vehicle','details.sparePart'])->get();
        $totalCost = $services->sum('cost');
        $approved  = $services->where('is_approved', true)->count();
        $total     = $services->count();
    @endphp

    <div class="svc-stats">
        <div class="svc-stat">
            <div class="svc-stat-label">Total Kendaraan</div>
            <div class="svc-stat-value accent">{{ $total }}</div>
        </div>
        <div class="svc-stat">
            <div class="svc-stat-label">Sudah Disetujui</div>
            <div class="svc-stat-value">{{ $approved }} / {{ $total }}</div>
        </div>
        <div class="svc-stat">
            <div class="svc-stat-label">Total Biaya</div>
            <div class="svc-stat-value accent">Rp {{ number_format($totalCost,0,',','.') }}</div>
        </div>
        <div class="svc-stat">
            <div class="svc-stat-label">Total Sparepart</div>
            <div class="svc-stat-value">{{ $services->sum(fn($s) => $s->details->count()) }}</div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="svc-table-wrap">
        <table class="svc-table">

            <thead>
                <tr>
                    <th>No Polisi</th>
                    <th>Tgl Service</th>
                    <th>No Register</th>
                    <th class="right">KM Service</th>
                    <th class="right">Biaya</th>
                    <th>Tgl Next</th>
                    <th class="center">Approve</th>
                </tr>
            </thead>

            <tbody>
            @foreach($services as $i => $service)

                {{-- SERVICE ROW --}}
                <tr class="svc-row-main">

                    <td>
                        <div class="svc-idx">#{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="svc-license">{{ $service->vehicle->license_plate ?? '-' }}</div>
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($service->service_date)->format('d M Y') }}
                    </td>

                    <td>
                        <span class="svc-reg">{{ $service->registration_number }}</span>
                    </td>

                    <td class="svc-km">
                        {{ number_format($service->km_service) }} <span style="font-size:10px;color:#444;font-weight:400">km</span>
                    </td>

                    <td class="svc-cost">
                        Rp {{ number_format($service->cost,0,',','.') }}
                    </td>

                    <td>
                        <span class="svc-date-next">
                            <span class="svc-date-next-dot"></span>
                            {{ \Carbon\Carbon::parse($service->next_service_date)->format('d M Y') }}
                        </span>
                    </td>

                    <td class="svc-approve-cell">
                        <div class="svc-cb-wrap">
                            <input type="checkbox"
                                class="svc-cb"
                                wire:click="approveService({{ $service->id }})"
                                {{ $service->is_approved ? 'checked' : '' }}>
                        </div>
                    </td>

                </tr>

                {{-- DETAIL SPAREPART --}}
                <tr class="svc-row-detail">
                    <td colspan="7">
                        <div class="svc-detail-table-wrap">
                            <table class="svc-detail-table">

                                <thead>
                                    <tr>
                                        <th>Sparepart</th>
                                        <th class="right">Approve</th>
                                    </tr>
                                </thead>

                             <tbody>
@foreach($service->details as $detail)
<tr>
    <td>
        <span class="svc-part-name">
            {{ $detail->sparePart->name ?? '-' }}
            <span style="margin-left:8px;color:#444;font-size:11px;">
                ({{ $detail->qty }} x Rp {{ number_format($detail->price,0,',','.') }})
            </span>
        </span>
    </td>

    <td class="svc-part-approve">
        <div class="svc-cb-wrap">
            <input type="checkbox"
                class="svc-cb"
                wire:click="approveDetail({{ $detail->id }})"
                {{ $detail->is_approved ? 'checked' : '' }}>
        </div>
    </td>
</tr>
@endforeach
</tbody>

                            </table>
                        </div>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
    </div>

</div>

</x-filament::page>