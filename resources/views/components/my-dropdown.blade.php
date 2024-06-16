<!-- Componente x-my-dropdown -->
<div x-data="{ open: false }" @click.away="open = false">
    <button
        class="flex items-center h-full w-full text-sm hover:no-underline max-w-48 overflow-hidden active:bg-gray-400 hover:bg-gray-300 active:bg-opacity-90 hover:bg-opacity-90 focus:bg-opacity-90 focus:bg-gray-300 gap-2 rounded-xl px-3 py-1 {{ $btnclass ?? ' bg-transparent' }}"
        @click="open = !open">
       {{ $boton }}
    </button>
    <div class="relative">
        <div x-show="open" class="absolute right-0 select-none overflow-hidden mt-1 w-48 text-sm bg-white border border-gray-200 rounded-md shadow-xl flex flex-col items-center">
            {{ $slot }}
        </div>
        
    </div>
    
</div>
