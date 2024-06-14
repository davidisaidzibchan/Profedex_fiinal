<div class="bg-pink-600 p-5 flex flex-col justify-start items-center min-h-screen ">
    <div class="w-full md:w-4/6 flex flex-col items-center py-2">
        <div class="w-full bg-orange-300 rounded-xl flex flex-col items-center gap-3 p-2">
            <div class="relative p-3 flex flex-col gap-5 w-full">
                <div class="absolute -top-2 -right-2 p-2 flex flex-col justify-center items-center ">
                    <div class="bg-black rounded-full p-1 hover:bg-gray-900 cursor-pointer active:bg-gray-800"
                        onclick="window.history.back()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            class="w-5 h-5 stroke-orange-300">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                <div class="w-full">
                    <h1 class="font-semibold text-sm">Consejo #{{ $consejoId->id }}</h1>
                    <span class="italic text-sm">
                        @if ($consejoId->anonimo)
                            Anónimo
                        @else
                            {{ $consejoId->user->username }}
                        @endif
                    </span>

                    </span>
                </div>
                <div class="w-full font-bold text-lg">
                    {{ $consejoId->titulo }}
                </div>
                <div class="flex flex-col gap-2">
                    <div class="w-full font-semibold text-sm flex justify-start items-center gap-2">
                        <div class="max-w-1/2 break-words">
                            {{ $consejoId->semestre }}</div>
                        <div class="min-h-5 h-full bg-black" style="width: 1px"></div>
                        <div class="max-w-1/2 break-words">
                            @isset($consejoId->profesor)
                                {{ $consejoId->profesor->nombre }}
                            @else
                                Sin profesor asignado
                            @endisset
                        </div>
                    </div>
                    <div class="w-full">
                        @isset($consejoId->materia)
                            {{ $consejoId->materia->nombre }}
                        @else
                            Sin materia especifica
                        @endisset
                    </div>
                </div>

                <div class="w-full text-sm overflow-hidden">
                    {{ $consejoId->consejo }}
                </div>
                <div class="flex gap-3 flex-wrap">
                    @php
                        $etiquetas = json_decode($consejoId->etiquetas);
                    @endphp

                    @if (empty($consejo->etiquetas))
                        #SinEtiquetas
                    @else
                        @foreach ($etiquetas as $etiqueta)
                            <div>{{ $etiqueta }}</div>
                        @endforeach
                    @endif
                </div>

            </div>
            @php
                $reaction = DB::table('reaccion_usuarios')
                    ->where('id_consejo', $consejoId->id)
                    ->where('id_usuario', auth()->id())
                    ->first();
            @endphp
            <div
                class="h-20 w-full rounded-b-2xl flex justify-center items-center p-2 gap-5 font-semibold overflow-hidden">
                <div class="w-1/2 flex justify-end items-center gap-1">
                    <div class="w-12 truncate text-right" wire:poll> {{ $consejoId->like }}</div>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        wire:click="like({{ $consejoId->id }})"
                        class="w-10 h-10 cursor-pointer active:animate-ping {{ $reaction && $reaction->reaccion == 1 ? 'fill-white' : 'fill-black' }}">
                        <path
                            d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                    </svg>
                </div>
                <div class="w-1/2 flex justify-start items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        wire:click="dislike({{ $consejoId->id }})"
                        class="w-10 h-10 cursor-pointer active:animate-ping {{ $reaction && $reaction->reaccion == 0 ? 'fill-white' : 'fill-black' }}">
                        <path
                            d="M15.73 5.5h1.035A7.465 7.465 0 0 1 18 9.625a7.465 7.465 0 0 1-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 0 1-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.499 4.499 0 0 0-.322 1.672v.633A.75.75 0 0 1 9 22a2.25 2.25 0 0 1-2.25-2.25c0-1.152.26-2.243.723-3.218.266-.558-.107-1.282-.725-1.282H3.622c-1.026 0-1.945-.694-2.054-1.715A12.137 12.137 0 0 1 1.5 12.25c0-2.848.992-5.464 2.649-7.521C4.537 4.247 5.136 4 5.754 4H9.77a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23ZM21.669 14.023c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.958 8.958 0 0 1-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227Z" />
                    </svg>
                    <div class="w-12 truncate text-left" wire:poll>{{ $consejoId->dislike }}</div>
                </div>
            </div>
        </div>
    </div>

    @if ($consejoId->id_usuario === auth()->id())
        <div class="flex gap-5 justify-center items-center">
            <button wire:click="toggleSaved({{ $consejoId->id }})" onclick="clearSavedText()"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                {{ $consejoId->guardado ? 'publicar' : 'Guardar' }}
            </button>
            <button wire:click="confirmDelete()"
                class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                Eliminar
            </button>
        </div>
    @endif

    @if ($openModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-5 rounded-lg shadow-lg">
                <div class="text-xl font-bold mb-3">¿Estás seguro de eliminar este consejo?</div>
                <div class="flex justify-center items-center gap-5">
                    <button wire:click="deleteConsejo()"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Sí, eliminar</button>
                    <button wire:click="closeModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Cancelar</button>
                </div>
            </div>
        </div>
    @endif


    @if ($savedText)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-5 rounded-lg shadow-lg">
                <div class="text-xl font-bold mb-3">{{ $savedText }}</div>        
            </div>
        </div>
    @endif


    <script>
        function clearSavedText() {
            setTimeout(function() {
                Livewire.dispatch('clearSavedText');
            }, 2000); // Tiempo en milisegundos (en este caso, 5000 ms o 5 segundos)
        }
    </script>
    
</div>
