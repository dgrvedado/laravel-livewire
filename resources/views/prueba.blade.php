<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prueba') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-welcome /> --}}
                {{-- @livewire('create-post', [
                    'title' => 'Hola IRIS!!!',
                    'user' => 1,
                    ])--}}
                {{-- @livewire('paises') --}}

            </div>

            {{--  @livewire('formulario')--}}

            {{--<div class="mt-8">
                @livewire('comments')
            </div> --}}

            {{-- @livewire('fathers') --}}

        </div>
    </div>
</x-app-layout>
