<div>
    <div class="bg-white shadow rounded-lg p-6 mb-8">
        @if ($postCreate->image)
            <img src="{{ $postCreate->image->temporaryUrl() }}" alt="" width="100px">
        @endif

        <form wire:submit="save" class="space-y-4">
            <div>
                <x-label for="name" value="Nombre" />
                <x-input class="w-full" type="text" wire:model.live="postCreate.title" />
                <x-input-error for="postCreate.title" />
            </div>
            <div>
                <x-label for="content" value="Contenido" />
                <x-textarea wire:model.live="postCreate.content" class="w-full"></x-textarea>
                <x-input-error for="postCreate.content" />
            </div>

            <div class="mb-4">
                <x-label for="category" value="Categoría" />
                <x-select wire:model.live="postCreate.category_id" class="w-full">
                    <option value="" disabled>Seleccione una categoría</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error for="postCreate.category_id" />
            </div>

            <div class="mb-4">
                <x-label for="image" value="Imagen" />
                <div
                    x-data="{ uploading: false, progress: 0 }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <!-- File Input -->
                    <x-input class="w-full" type="file" wire:model="postCreate.image" wire:key="{{ $postCreate->imageKey }}" />

                    <!-- Progress Bar -->
                    <div x-show="uploading">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>
                </div>


                {{-- <x-input-error for="postCreate.title" /> --}}
            </div>

            <div class="mb-4">
                <x-label for="tags" value="Etiquetas" />
                <ul>
                    @foreach($tags as $tag)
                        <li>
                            <label class="inline-flex items-center">
                                <x-checkbox wire:model="postCreate.tags" value="{{ $tag->id }}" />
                                <span class="ml-2">{{ $tag->name }}</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
                <x-input-error for="postCreate.tags" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button type="submit" class="ml-4">
                    {{-- para deshabilitar el boton mientras realiza la carga se puede usar wire:loading.attr="disabled" --}}
                    Crear
                </x-button>

            </div>

        </form>
        {{-- <div wire:loading wire:target="save"> --}}
            {{-- con wire:loading.remove ocurre el efecto contrario --}}
            {{-- Procesando... --}}
    </div>

    <div class="bg-white shadow rounded-lg p-6">
        <div class="mb-4">
            <x-input  class="w-full" placeholder="Buscar..." wire:model.live="search" />
        </div>

        <ul class="list-disc list-inside space-y-2">
            @forelse($posts as $post)
                <li class="flex justify-between" wire:key="post-{{ $post->id }}">
                    <b>{{ $post->title }}</b> Categoría: {{ $post->category->name }}
                    <div>
                        <x-button class="ml-4 bg-blue-500" wire:click="edit({{ $post->id }})"><i class="fa-regular fa-pen-to-square"></i></x-button>
                        <x-danger-button class="ml-4" wire:click="delete({{ $post->id }})"><i class="fa-regular fa-trash-can"></i></x-danger-button>
                    </div>

                </li>
            @empty
                <li>No hay posts</li>
            @endforelse
        </ul>
        <div class="mt-4">
            {{ $posts->links() }}
        </div>
    </div>

    {{-- @if ($showModalEdit)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow rounded-lg p-6">
                    <form wire:submit="update" class="space-y-4">
                        <div>
                            <x-label for="name" value="Nombre" />
                            <x-input class="w-full" type="text" wire:model="postEdit.title" />
                        </div>
                        <div>
                            <x-label for="content" value="Contenido" />
                            <x-textarea wire:model="postEdit.content" class="w-full"></x-textarea>
                        </div>

                        <div class="mb-4">
                            <x-label for="category" value="Categoría" />
                            <x-select wire:model="postEdit.category_id" class="w-full">
                                <option value="" disabled>Seleccione una categoría</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                        </div>

                        <div class="mb-4">
                            <x-label for="tags" value="Etiquetas" />
                            <ul>
                                @foreach($tags as $tag)
                                    <li>
                                        <label class="inline-flex items-center">
                                            <x-checkbox wire:model="postEdit.tags" value="{{ $tag->id }}" />
                                            <span class="ml-2">{{ $tag->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="flex justify-end mt-4">
                            <x-danger-button class="mr-2" wire:click="$set('showModalEdit', false)">
                                Cancelar
                            </x-danger-button>
                            <x-button type="submit" class="ml-4">
                                Actualizar
                            </x-button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif --}}

    <form wire:submit="update" class="space-y-4">
        <x-dialog-modal wire:model.live="postEdit.showModalEdit">
            <x-slot name="title">Actualizar post</x-slot>

            <x-slot name="content">

                <div>
                    <x-label for="name" value="Nombre" />
                    <x-input class="w-full" type="text" wire:model="postEdit.title" />
                    <x-input-error for="postEdit.title" />
                </div>
                <div>
                    <x-label for="content" value="Contenido" />
                    <x-textarea wire:model="postEdit.content" class="w-full"></x-textarea>
                    <x-input-error for="postEdit.content" />
                </div>

                <div class="mb-4">
                    <x-label for="category" value="Categoría" />
                    <x-select wire:model="postEdit.category_id" class="w-full">
                        <option value="" disabled>Seleccione una categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>
                    <x-input-error for="postEdit.category_id" />
                </div>

                <div class="mb-4">
                    <x-label for="tags" value="Etiquetas" />
                    <ul>
                        @foreach($tags as $tag)
                            <li>
                                <label class="inline-flex items-center">
                                    <x-checkbox wire:model="postEdit.tags" value="{{ $tag->id }}" />
                                    <span class="ml-2">{{ $tag->name }}</span>
                                </label>
                            </li>
                        @endforeach
                    </ul>
                    <x-input-error for="postEdit.tags" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="flex justify-end mt-4">
                    <x-danger-button class="mr-2" wire:click="$set('postEdit.showModalEdit', false)">
                        Cancelar
                    </x-danger-button>
                    <x-button type="submit" class="ml-4">
                        Actualizar
                    </x-button>

                </div>
            </x-slot>
        </x-dialog-modal>
    </form>

    @push('scripts')
        <script>
            Livewire.on('post-event', function(message) {
                console.log(message);
            });
        </script>

    @endpush
</div>
