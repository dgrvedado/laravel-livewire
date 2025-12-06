<div>
    <x-button class="mb-4" wire:click="redirigir">Prueba</x-button>
    <h1 class="text-2xl font-semibold">Soy Componente Fathers</h1>

    <x-input wire:model.live="name" />

    <hr class="my-6">

    <div>
        {{--
            La diferencia entre la 1ra opcion y la 2da es que en la 1ra puedo pasar mas de una propiedad.
            Mientras que en la 2da solo podre pasar 1 sola propiedad.

        {{ @livewire('childrens', [
            'name' => $name
        ]) }}
        --}}
        {{-- <livewire:childrens wire:model="name" /> --}}
        @livewire('contador', [], key('contador-1'))
        @livewire('contador', [], key('contador-2'))
        @livewire('contador', [], key('contador-3'))
        {{-- <livewire:contador key="contador-N" /> --}}
    </div>
</div>
