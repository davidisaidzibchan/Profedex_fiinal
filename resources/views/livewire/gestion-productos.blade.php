<div class="flex flex-col justify-center items-center w-full">
    <div class=" absolute top-14 h-14 bg-purple-600 text-white w-full py-3 px-6">
        <h1 class="text-xl font-bold">Gestión de Productos</h1>
    </div>
    <div class="bg-gradient-to-b mt-14 py-5 from-blue-400 to-purple-600 w-full p-3 shadow-lg"
        style="min-height: calc(100vh - 3.5rem)">
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 500)"
                class="fixed z-50 inset-0 flex items-center justify-center">
                <div class="bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>{{ session('message') }}</span>
                    </div>
                </div>
            </div>
        @endif
        @if (session()->has('message_delete'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 500)"
                class="fixed z-50 inset-0 flex items-center justify-center">
                <div class="bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>{{ session('message_delete') }}</span>
                    </div>
                </div>
            </div>
        @endif
        <div class="flex justify-end mb-4">
            <button wire:click="create()" class="bg-green-500 text-white font-bold py-2 px-4 rounded">Crear
                Producto</button>
        </div>
        @if ($isOpen)
            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="fixed inset-0 bg-gray-800 opacity-75"></div>
                    <div class="bg-white mt-14 rounded-lg shadow-lg overflow-hidden max-w-lg w-full z-20">
                        <div class="p-3">
                            <h2 class="text-2xl font-bold mb-4">
                                {{ $producto_id ? 'Editar Producto' : 'Crear Producto' }}</h2>
                            <form>
                                <div class="mb-4">
                                    <label for="nombre" class="block text-gray-700">Nombre:</label>
                                    <input type="text" id="nombre" wire:model="nombre"
                                        class="w-full px-2 py-1 border rounded-lg">
                                    @error('nombre')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="precio" class="block text-gray-700">Precio:</label>
                                    <input type="number" id="precio" wire:model="precio"
                                        class="w-full px-2 py-1 border rounded-lg">
                                    @error('precio')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="descripcion" class="block text-gray-700">Descripcion:</label>
                                    <textarea id="descripcion" wire:model="descripcion" class="w-full px-2 py-1 border rounded-lg"></textarea>
                                    @error('descripcion')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block text-gray-700">Imagen:</label>
                                    <div class=" flex flex-col gap-1">
                                        <div class="w-32 h-32 rounded-xl overflow-hidden">
                                            @if ($imagen)
                                                @if ($imagen instanceof \Illuminate\Http\UploadedFile)
                                                    <img src="{{ $imagen->temporaryUrl() }}" alt="Imagen"
                                                        class="w-full h-full object-cover mb-2">
                                                @else
                                                    <img src="{{ asset($imagen) }}" alt="Imagen"
                                                        class="w-full h-full object-cover mb-2">
                                                @endif
                                            @else
                                                <img src="{{ asset('img/image-placeholder.svg') }}"
                                                    alt="Imagen por defecto 1" class="w-full h-full object-cover mb-2">
                                            @endif
                                        </div>
                                        <label for="imagen"
                                            class="bg-amber-600 text-center w-32 px-3 py-2 text-white rounded-xl">Subir
                                            archivo</label>
                                        <input type="file" id="imagen" wire:model="imagen" class="hidden">
                                        @error('imagen')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="flex justify-end">
                                    <button wire:click.prevent="store()"
                                        class="bg-blue-500 text-white font-bold py-2 px-4 rounded">Guardar</button>
                                    <button wire:click="closeModal()"
                                        class="bg-gray-500 text-white font-bold py-2 px-4 rounded ml-2">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($isOpenConfirmationModal)
            <div class="fixed z-50 inset-0 overflow-y-auto flex items-center justify-center">
                <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
                <div
                    class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
                    <div class="modal-content py-4 text-left px-6">
                        <div class="flex justify-between items-center pb-3">
                            <p class="text-2xl font-bold">Confirmar Eliminación</p>
                            <button class="modal-close cursor-pointer z-50" wire:click="closeModalConfirmation()">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18"
                                    height="18" viewBox="0 0 18 18">
                                    <path d="M1 1l16 16m0-16L1 17" fill="none" stroke="#000" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </button>
                        </div>
                        <p>¿Estás seguro de que deseas eliminar este producto?</p>
                        <div class="mt-4 flex justify-end">
                            <button wire:click="delete()" class="px-4 py-2 bg-red-500 text-white rounded mr-2">
                                Eliminar
                            </button>
                            <button wire:click="closeModalConfirmation()"
                                class="px-4 py-2 bg-gray-400 text-white rounded">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="w-full overflow-auto text-xs">
            <table class="table-auto w-full bg-white rounded-xl shadow overflow-hidden">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-center">ID</th>
                        <th class="px-4 py-2 text-center">Nombre</th>
                        <th class="px-4 py-2 text-center">Precio</th>
                        <th class="px-4 py-2 text-center">Descripcion</th>
                        <th class="px-4 py-2 text-center">Imagen</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $producto->id }}</td>
                            <td class="border px-4 py-2 text-center">{{ $producto->nombre }}</td>
                            <td class="border px-4 py-2 text-center">{{ $producto->precio }}</td>
                            <td class="border px-4 py-2 text-center">
                                <div class="w-60">
                                    {{ $producto->descripcion }}
                                </div>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <div class="w-28 h-32">
                                    <img src="{{ asset($producto->imagen_path) }}" alt="Imagen1"
                                        class="w-full h-full object-cover">
                                </div>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <button wire:click="edit({{ $producto->id }})"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded shadow">Editar</button>
                                    <button wire:click="confirmDelete({{ $producto->id }})"
                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded shadow">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
