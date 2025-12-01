<div>

    {{-- @livewire('hijo') --}}

    <x-button class="mb-4" wire:click="$set('count', 0)">Reset</x-button>
    <x-button class="mb-4" wire:click="$toggle('open')">Mostrar/Ocultar Array</x-button>

    <form class="mb-4" wire:submit="save">
        <x-input type="text" wire:model="pais" placeholder="Ingrese un país" wire:keydown="increment" />
        {{ $count }}
        <x-button>Agregar País</x-button>
    </form>

    @if ($open == true)
        <ul class="list-disc list-inside space-y-2">
            @foreach($paises as $index => $pais)
                <li wire:key="pais-{{ $index }}">
                    <span wire:mouseenter="chageActive('{{ $pais }}')">{{ $pais }}</span>
                <x-danger-button wire:click="delete('{{ $index }}')">X</x-danger-button></li>
            @endforeach
        </ul>
        {{ $active }}
    @endif



</div>
