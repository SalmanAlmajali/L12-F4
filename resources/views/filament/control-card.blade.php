<x-filament-panels::page>
    <div class="grid grid-cols-4 gap-6">

        <div class="col-span-1 space-y-4">
            {{ $this->form }}

            <x-filament::button
                wire:click="$refresh"
            >
                Search
            </x-filament::button>
        </div>

        <div class="col-span-3">
            {{ $this->table }}
        </div>

    </div>
</x-filament-panels::page>