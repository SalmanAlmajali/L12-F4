<x-filament::page>
    <div class="tracking-container">
        <div class="vehicle-sidebar shadow-2xl">
            <div class="sidebar-header border-b border-white/10 bg-[#111827]">
                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-3">Unit Monitoring</h3>
                <x-filament::input.wrapper class="bg-gray-800 border-gray-700">
                    <x-filament::input
                        type="text"
                        placeholder="Cari No Polisi..."
                        wire:model.live.debounce.500ms="search"
                        class="text-white placeholder-gray-500"
                    />
                </x-filament::input.wrapper>
            </div>

            <div class="vehicle-list custom-scrollbar bg-[#0f172a]">
                @forelse($this->vehicles as $vehicle)
                    @php
                        $lat = $vehicle->latestGps?->latitude ?? -6.2000;
                        $lng = $vehicle->latestGps?->longitude ?? 106.8166;
                        $plate = $vehicle->license_plate;
                        $type = $vehicle->model_type;
                        $addr = $vehicle->latestGps?->address ?? 'Lokasi tidak terdeteksi';
                    @endphp
                    <button 
                        wire:key="veh-{{ $vehicle->id }}" 
                        class="vehicle-item group border-b border-white/5"
                        onclick="focusToMarker({{ $lat }}, {{ $lng }}, '{{ $plate }}', '{{ $type }}')"
                    >
                        <div class="flex justify-between items-center mb-1">
                            {{-- Plat nomor dibuat Putih Terang --}}
                            <span class="font-black text-white uppercase tracking-tight text-sm group-hover:text-primary-400 transition-colors">
                                {{ $plate }}
                            </span>
                            <span class="text-[9px] bg-primary-500/20 text-primary-400 font-extrabold px-1.5 py-0.5 rounded border border-primary-500/30 uppercase">
                                {{ $type }}
                            </span>
                        </div>
                        <div class="text-[10px] text-gray-400 truncate flex items-center gap-1 italic">
                            <x-heroicon-m-map-pin class="w-3 h-3 text-primary-500"/>
                            {{ $addr }}
                        </div>
                    </button>
                @empty
                    <div class="p-10 text-center">
                        <p class="text-xs text-gray-500 italic">Data tidak ditemukan</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="map-area">
            <div class="map-legend">
                <div class="flex items-center gap-2 font-bold text-gray-700">
                    <span class="w-3 h-3 rounded-full bg-green-500 shadow-sm animate-pulse"></span> 
                    <span>MOBIL</span>
                </div>
                <div class="w-px h-4 bg-gray-300 mx-1"></div>
                <div class="flex items-center gap-2 font-bold text-gray-700">
                    <span class="w-3 h-3 rounded-full bg-red-500 shadow-sm"></span> 
                    <span>MOTOR</span>
                </div>
            </div>
            
            <div id="map" wire:ignore class="map-canvas shadow-inner">
                <div class="flex flex-col items-center justify-center h-full opacity-50">
                    <x-filament::loading-indicator class="w-10 h-10 text-primary-500 mb-2"/>
                    <p class="text-xs font-black text-primary-900 uppercase tracking-widest italic">Menghubungkan Satelit...</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .fi-main-ctn > div { max-width: none !important; padding: 0 !important; }
        .fi-page-header { padding: 1.25rem 2rem !important; margin-bottom: 0 !important; border-bottom: 1px solid #e2e8f0; }

        .tracking-container {
            display: flex;
            height: calc(100vh - 165px);
            background: #f1f5f9;
            margin: 0; 
            overflow: hidden;
        }

        /* SIDEBAR HITAM */
        .vehicle-sidebar {
            width: 320px;
            background: #0f172a !important; /* Biru sangat gelap hampir hitam */
            display: flex;
            flex-direction: column;
            z-index: 20;
        }

        .sidebar-header { padding: 1.5rem; }
        .vehicle-list { flex: 1; overflow-y: auto; }

        .vehicle-item {
            width: 100%;
            text-align: left;
            padding: 1.25rem;
            transition: all 0.3s ease;
        }
        .vehicle-item:hover { 
            background: #1e293b; /* Warna saat hover lebih terang dikit */
            padding-left: 1.75rem;
            box-shadow: inset 5px 0 0 0 rgb(var(--primary-500));
        }

        .map-area { flex: 1; position: relative; background: #abd1ee; }
        .map-canvas { width: 100%; height: 100%; z-index: 10; }

        .map-legend {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 30;
            background: rgba(255, 255, 255, 0.95);
            padding: 0.75rem 1.25rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 11px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);
            border: 1px solid #e2e8f0;
            backdrop-filter: blur(4px);
        }

        .custom-scrollbar::-webkit-scrollbar { width: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #334155; border-radius: 10px; }
    </style>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        var map;
        var markers = {};

        document.addEventListener('livewire:navigated', () => {
            map = L.map('map', { zoomControl: false }).setView([-6.2000, 106.8166], 12);
            L.control.zoom({ position: 'bottomright' }).addTo(map);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            const vehicles = @json($this->vehicles);
            vehicles.forEach(v => {
                if (v.latest_gps) {
                    const m = L.marker([v.latest_gps.latitude, v.latest_gps.longitude]).addTo(map)
                        .bindPopup(`<b>${v.license_plate}</b><br>${v.model_type}`);
                    markers[v.license_plate] = m;
                }
            });
        });

        function focusToMarker(lat, lng, plate, type) {
            if (!map) return;
            map.flyTo([lat, lng], 17, { animate: true, duration: 1.5 });
            if (markers[plate]) { markers[plate].openPopup(); }
        }
    </script>
</x-filament::page>