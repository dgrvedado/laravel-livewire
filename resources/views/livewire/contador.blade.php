<div>
    <x-button wire:click="decrement">-</x-button>
        <span class="mx-2">Contador: {{ $count }}</span>
    <x-button wire:click="increment">+</x-button>
    {{-- Se pueden pasar parametros en los metodos ej: increment(2) --}}
    {{-- Luego en el Controlador en increment aceptar el parametos $cant
        Y usarlo como estimemos oportuno. --}}

</div>
