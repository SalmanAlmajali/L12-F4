<x-filament::page>
    <div class="bg-white dark:bg-gray-900 shadow-sm rounded-xl border border-gray-200 dark:border-gray-800">
        <div class="p-4 border-b border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50 rounded-t-xl">
            <h2 class="text-lg font-bold">Data Log GPS Kendaraan</h2>
            <p class="text-xs text-gray-500">Menampilkan seluruh riwayat koordinat yang masuk ke sistem.</p>
        </div>
        
        <div class="p-4">
            {{ $this->table }}
        </div>
    </div>
</x-filament::page>