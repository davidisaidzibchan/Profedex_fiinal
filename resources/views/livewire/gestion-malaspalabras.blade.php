<div class="max-w-lg mx-auto p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Gestión de Malapalabras</h1>

    <form wire:submit.prevent="{{ $palabraId ? 'update' : 'store' }}" class="mb-6">
        <div class="flex flex-col sm:flex-row justify-center sm:items-start items-center space-y-2 sm:space-y-0 sm:space-x-2">
            <div class="flex-1 w-full">
                <input type="text" wire:model="palabra"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Añadir o actualizar palabra">
                @error('palabra')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex space-x-2">
                <button type="submit"
                    class="px-4 py-2 {{ $palabraId ? 'bg-green-500 hover:bg-green-600' : 'bg-blue-500 hover:bg-blue-600' }} text-white rounded-md">
                    {{ $palabraId ? 'Actualizar' : 'Añadir' }}
                </button>
                @if ($palabraId)
                    <button type="button" wire:click="cancel"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Cancelar</button>
                @endif
            </div>
        </div>
    </form>

    <div class="bg-gray-100 p-4 rounded-lg shadow-inner">
        <h2 class="text-xl font-semibold mb-2">Lista de Malapalabras</h2>
        <ul class="divide-y divide-gray-300">
            @foreach ($malaspalabras as $malapalabra)
                <li class="py-2 flex justify-between items-center">
                    <span>{{ $malapalabra->palabra }}</span>
                    <div class="space-x-2">
                        <button wire:click="edit({{ $malapalabra->id }})"
                            class="px-2 py-1 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Editar</button>
                        <button wire:click="delete({{ $malapalabra->id }})"
                            class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">Eliminar</button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
