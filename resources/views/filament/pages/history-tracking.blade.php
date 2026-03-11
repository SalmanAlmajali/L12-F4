<x-filament::page>
    <div class="tracking-container">
        <div class="vehicle-sidebar shadow-2xl">
            <div class="sidebar-header border-b border-white/10 bg-[#111827] p-6">
                <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Filter History</h3>
                
                <div class="space-y-4">
                    {{-- Select Kendaraan --}}
                    <div>
                        <label class="text-[10px] text-gray-500 font-bold uppercase">No Polisi</label>
                        <select wire:model="selectedVehicle" class="w-full bg-gray-800 text-white border-gray-700 rounded-lg text-sm">
                            <option value="">Pilih Kendaraan</option>
                            @foreach(\App\Models\Vehicle::all() as $v)
                                <option value="{{ $v->id }}">{{ $v->license_plate }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Input Tanggal --}}
                    <div>
                        <label class="text-[10px] text-gray-500 font-bold uppercase">Tanggal</label>
                        <input type="date" wire:model="selectedDate" class="w-full bg-gray-800 text-white border-gray-700 rounded-lg text-sm">
                    </div>

                    {{-- Tombol GO --}}
                    <x-filament::button wire:click="$refresh" class="w-full">
                        CARI RUTE
                    </x-filament::button>
                </div>
            </div>

            <div class="p-6">
                <p class="text-[10px] text-gray-500 italic leading-relaxed">
                    * Pilih kendaraan dan tanggal untuk melihat riwayat perjalanan di peta.
                </p>
            </div>
        </div>

        <div class="map-area">
            <div id="map" wire:ignore class="map-canvas"></div>
        </div>
    </div>

    <style>
        .fi-main-ctn > div { max-width: none !important; padding: 0 !important; }
        .tracking-container { display: flex; height: calc(100vh - 165px); overflow: hidden; }
        .vehicle-sidebar { width: 320px; background: #0f172a !important; z-index: 20; }
        .map-area { flex: 1; background: #abd1ee; position: relative; }
        .map-canvas { width: 100%; height: 100%; }
    </style>

    {{-- Script Leaflet untuk Polyline --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        var map;
        var routeLayer;
        var markers = [];

        document.addEventListener('livewire:navigated', () => {
            map = L.map('map').setView([-6.2000, 106.8166], 12);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        });

        // Listen data dari Livewire
        window.addEventListener('render-route', event => {
            const path = event.detail.coords; // Array dari koordinat

            // Hapus rute lama jika ada
            if (routeLayer) map.removeLayer(routeLayer);
            markers.forEach(m => map.removeLayer(m));
            markers = [];

            if (path.length > 0) {
                const latLngs = path.map(p => [p.lat, p.lng]);

                // 1. Gambar Garis Rute (Polyline) - Warna Coklat/Merah sesuai gambar kamu
                routeLayer = L.polyline(latLngs, {
                    color: '#8B4513', 
                    weight: 4,
                    opacity: 0.8,
                    dashArray: '10, 10'
                }).addTo(map);

                // 2. Tambah Marker di setiap titik
                path.forEach((p, index) => {
                    const marker = L.circleMarker([p.lat, p.lng], {
                        radius: 5,
                        fillColor: "#ff0000",
                        color: "#fff",
                        weight: 1,
                        opacity: 1,
                        fillOpacity: 0.8
                    }).addTo(map).bindPopup("Jam: " + p.time);
                    markers.push(marker);
                });

                // Zoom ke rute
                map.fitBounds(routeLayer.getBounds());
            }
        });
    </script>
</x-filament::page>