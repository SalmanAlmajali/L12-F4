<x-filament-panels::page>
    <form wire:submit="submit">
        {{ $this->form }}
        
        <div class="mt-4 flex justify-start">
            <x-filament::button type="submit" color="warning">
                Search
            </x-filament::button>
        </div>
    </form>

    <div class="mt-8">
        {{ $this->table }}
    </div>
</x-filament-panels::page>