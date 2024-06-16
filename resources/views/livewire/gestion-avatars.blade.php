<div class="flex flex-col justify-center items-center w-full">
    <div class=" absolute top-14 h-14 bg-purple-600 text-white w-full py-3 px-6">
        <h1 class="text-xl font-bold">Gestión de Avatars</h1>
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
                avatar</button>
        </div>
        @if ($isOpen)
            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="fixed inset-0 bg-gray-800 opacity-75"></div>
                    <div class="bg-white mt-14 rounded-lg shadow-lg overflow-hidden max-w-lg w-full z-20">
                        <div class="p-3">
                            <h2 class="text-2xl font-bold mb-4">{{ $nombre ? 'Editar avatar' : 'Crear avatar' }}</h2>
                            <form>
                                <div class="mb-4">
                                    <label for="prefijo" class="block text-gray-700">Prefijo:</label>
                                    <select id="prefijo" wire:model="prefijo"
                                        class="w-full px-2 py-1 border rounded-lg">
                                        <option value="">Seleccione un profesor</option>
                                        @foreach ($profesores as $profesor)
                                            @php
                                                $nombresProfesor = explode(' ', $profesor->nombre);
                                                $nombreFormateado =
                                                    count($nombresProfesor) >= 3
                                                        ? $nombresProfesor[0] . ' ' . $nombresProfesor[2]
                                                        : $profesor->nombre;
                                            @endphp
                                            <option value="{{ $nombreFormateado }}"
                                                {{ $prefijo == $nombreFormateado ? 'selected' : '' }}>
                                                {{ $nombreFormateado }}</option>
                                        @endforeach
                                    </select>

                                    @error('prefijo')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="nombre" class="block text-gray-700">Nombre:</label>
                                    <input type="text" id="nombre" wire:model="nombre"
                                        class="w-full px-2 py-1 border rounded-lg">
                                    @error('nombre')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-gray-700">Imagen:</label>
                                    <div class="flex flex-col gap-1">
                                        <div class="w-32 h-32 rounded-xl overflow-hidden">
                                            @if ($imagen instanceof \Illuminate\Http\UploadedFile)
                                                <img src="{{ $imagen->temporaryUrl() }}" alt="Imagen" class="w-full h-full object-cover mb-2">
                                            @elseif ($imagenPath)
                                                <img src="{{ asset('storage/' . $imagenPath) }}" alt="Imagen" class="w-full h-full object-cover mb-2">
                                            @else
                                                <img src="{{ asset('img/image-placeholder.svg') }}" alt="Imagen por defecto" class="w-full h-full object-cover mb-2">
                                            @endif
                                        </div>
                                        <label for="imagen" class="bg-amber-600 text-center w-32 px-3 py-2 text-white rounded-xl">Subir archivo</label>
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
                        <p>¿Estás seguro de que deseas eliminar este avatar?</p>
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
            @php
                $groupedAvatars = collect($avatars)->groupBy(function($avatar) {
                    return explode('_', basename($avatar))[0];
                });
            @endphp
        
            @foreach ($groupedAvatars as $prefijo => $avatarsPorPrefijo)
                <div class="mt-4 mb-20">
                    <h2 class="text-lg font-bold mb-4 uppercase border-b-4 border-black">{{ $prefijo }}</h2>
                    <div class="flex flex-wrap gap-4 justify-center items-center">
                        @foreach ($avatarsPorPrefijo as $avatar)
                            <div class="flex md:w-44 w-28 flex-col items-center justify-center bg-white rounded-xl overflow-hidden">
                                <div class=" w-full bg-slate-400"> 
                                  <img class="h-full w-full object-cover" src="{{ asset('storage/' . $avatar) }}" alt="avatar" />
                                </div>
                                <div class="flex md:flex-row flex-col w-full">
                                  <button wire:click="edit('{{ $avatar }}')" class="flex md:w-1/2 w-full items-center justify-center gap-1 p-2 cursor-pointer md:border-r bg-blue-600 text-white hover:bg-blue-500 active:bg-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                      <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                      <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                    </svg>
                                    <div class="text-sm font-semibold" >Editar</div>
                                  </button>
                                  <button wire:click="confirmDelete('{{ $avatar }}')" class="flex md:w-1/2 w-full  items-center justify-center gap-1 p-2 cursor-pointer bg-red-600 text-white hover:bg-red-500 active:bg-red-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                      <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z" clip-rule="evenodd" />
                                    </svg>
                                    <div class="text-sm font-semibold">Eliminar</div>
                                  </button>
                                </div>
                              </div>
                              
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
        

    </div>
</div>
