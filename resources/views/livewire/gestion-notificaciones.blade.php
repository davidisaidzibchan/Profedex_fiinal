<div class="flex flex-col justify-center items-center w-full">
    <div class=" absolute top-14 h-14 bg-purple-600 text-white w-full py-3 px-6">
        <h1 class="text-xl font-bold">Gestión de Notificaciones</h1>
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
                Notificacion</button>
        </div>
        @if ($isOpen)
            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="fixed inset-0 bg-gray-800 opacity-75"></div>
                    <div class="bg-white mt-14 rounded-lg shadow-lg overflow-hidden max-w-lg w-full z-20">
                        <div class="p-3">
                            <h2 class="text-2xl font-bold mb-4">
                                {{ $noti_id ? 'Editar Notificacion' : 'Crear Notificacion' }}</h2>
                            <form>
                                <div class="mb-4">

                                    <label for="id_consejo" class="block text-gray-700">Consejo:</label>
                                    <select id="id_consejo" wire:model="id_consejo"
                                        class="w-full px-2 py-1 border rounded-lg">
                                        <option value="">Selec. consejo</option>
                                        @foreach ($consejos as $consejo)
                                            <option value="{{ $consejo->id }}"
                                                {{ $id_consejo == $consejo->id ? 'selected' : '' }}>
                                                {{ $consejo->titulo }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_consejo')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="id_usuario" class="block text-gray-700">Usuario:</label>
                                    <select id="id_usuario" wire:model="id_usuario"
                                        class="w-full px-2 py-1 border rounded-lg">
                                        <option value="">Selec. usuario</option>
                                        @foreach ($usuarios as $usuario)
                                            <option value="{{ $usuario->id }}"
                                                {{ $id_usuario == $usuario->id ? 'selected' : '' }}>
                                                {{ $usuario->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_usuario')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mensaje" class="block text-gray-700">Mensaje:</label>
                                    <textarea id="mensaje" wire:model="mensaje" class="w-full px-2 py-1 border rounded-lg"></textarea>
                                    @error('mensaje')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="tipo" class="block text-gray-700">Tipo:</label>
                                    <select id="tipo" wire:model="tipo" class="w-full px-2 py-1 border rounded-lg">
                                        <option value="">Selec. tipo</option>
                                        <option value="1" {{ $tipo == '1' ? 'selected' : '' }}>Consejo
                                            aprobado
                                        </option>
                                        <option value="2" {{ $tipo == '2' ? 'selected' : '' }}>Consejo
                                            declinado
                                        </option>
                                        <option value="3" {{ $tipo == '3' ? 'selected' : '' }}>Like recibido
                                        </option>
                                    </select>
                                    @error('tipo')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
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
                        <p>¿Estás seguro de que deseas eliminar esta notificacion?</p>
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
                        <th class="px-4 py-2 text-center">Consejo</th>
                        <th class="px-4 py-2 text-center">Usuario</th>
                        <th class="px-4 py-2 text-center">Mensaje</th>
                        <th class="px-4 py-2 text-center">Tipo</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notificaciones as $noti)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $noti->id }}</td>
                            <td class="border px-4 py-2 text-center">{{ $noti->consejo->titulo }}</td>
                            <td class="border px-4 py-2 text-center">{{ $noti->usuario->name }}</td>
                            <td class="border px-4 py-2 text-center">{{ $noti->mensaje }}</td>
                            <td class="border px-4 py-2 text-center">
                                @if ($noti->tipo == 1)
                                    Consejo aprobado
                                @elseif($noti->tipo == 2)
                                    Consejo declinado
                                @elseif($noti->tipo == 3)
                                    Like recibido
                                @endif
                            </td>

                            <td class="border px-4 py-2 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <button wire:click="edit({{ $noti->id }})"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded shadow">Editar</button>
                                    <button wire:click="confirmDelete({{ $noti->id }})"
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
