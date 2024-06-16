<div class="flex flex-col items-center justify-start gap-3">
    <div class="w-full p-2 bg-amber-500 ">
        <div class="w-full px-5 text-sm mb-4 md:text-center">Neque porro quisquam est qui dolorem ipsum quia dolor sit
            amet,
            consectetur,
            adipisci
            velit...
        </div>
        <div class="w-full flex gap-3 px-5 justify-center items-center">
            <x-my-search-input placeholder="Buscar profesores..." wire:model="search" wire:input="$refresh" />
            <div class="w-1/2 md:w-auto flex flex-col items-center justify-start gap-3 z-10">
                <x-my-dropdown btnclass="bg-white border-2 border-black focus:bg-white">
                    <x-slot name="boton">
                        <svg id="dropdown-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                        </svg>
                        <h1>{{ $selectedOption }}</h1>
                    </x-slot>
                    <div class="w-full" wire:click="changeSelectedOption('A-Z')">
                        <x-my-dropdown-link>
                            A-Z
                        </x-my-dropdown-link>
                    </div>
                    <div class="w-full" wire:click="changeSelectedOption('Z-A')">
                        <x-my-dropdown-link>
                            Z-A
                        </x-my-dropdown-link>
                    </div>
                    <div class="w-full" wire:click="changeSelectedOption('Más popular')">
                        <x-my-dropdown-link>
                            Más popular
                        </x-my-dropdown-link>
                    </div>
                    <div class="w-full" wire:click="changeSelectedOption('Menos popular')">
                        <x-my-dropdown-link>
                            Menos popular
                        </x-my-dropdown-link>
                    </div>
                    <div class="w-full" wire:click="changeSelectedOption('Mis likes')">
                        <x-my-dropdown-link>
                            Mis likes
                        </x-my-dropdown-link>
                    </div>
                </x-my-dropdown>
            </div>
        </div>
    </div>
    <div class="w-full bg-teal-600 flex flex-wrap justify-center items-center gap-10 pt-10 pb-10">
        @if ($showNoResults)
            <div class="text-green-500">No hay resultados</div>
        @else
            @foreach ($profesores as $index => $profesor)
                <div id="flip-card-inner-{{ $index }}" class="flip-card group w-60 h-72 [perspective:1000px]">
                    <div class="flip-card-inner cursor-pointer relative w-full h-full transition-all duration-500 [transform-style:preserve-3d]"
                        style="{{ isset($flippedCards[$index]) ? 'transform: rotateY(180deg)' : '' }}">
                        <div
                            class="flip-card-front inset-0 border-4 overflow-hidden bg-black absolute w-full h-full [backface-visibility:hidden]">
                            <img id="btnClic" src="{{ asset(json_decode($profesor->imagen)[0]) }}"
                                alt="{{ asset(json_decode($profesor->imagen)[0]) }}"
                                class="w-full h-full object-cover bg-no-repeat object-top">
                            <div class="absolute inset-0 bg-black opacity-40"></div>
                            <div class="absolute inset-0 flex flex-col justify-between">
                                <div class="absolute top-1/2 -left-3 flex flex-col justify-center items-center w-16">
                                    <svg wire:click="toggleFlip({{ $index }})" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="w-8 h-8 stroke-white bg-sky-500 rounded-full p-1 cursor-pointer">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                    </svg>
                                </div>
                                <div onclick="stopPropagation(event)"
                                    class="absolute top-0 right-0 p-2 flex flex-col justify-center items-center w-16">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5"
                                        wire:click="toggleLike({{ $profesor->id }})" stroke="currentColor"
                                        class="w-10 h-10 stroke-none cursor-pointer {{ Auth::user()->profesores()->where('id_profesor', $profesor->id)->exists()? 'fill-red-600 ': 'fill-white ' }} active:animate-ping">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                                    </svg>
                                    <span class="text-sm text-white"
                                        wire:poll>{{ \App\Models\Profesor::where('id', $profesor->id)->first()->like }}</span>
                                </div>
                                <div class="absolute bottom-0 w-full text-white uppercase  text-lg text-center">
                                    <div>
                                        {{ $profesor->nombre }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="flip-card-back flex inset-0 overflow-hidden border-4 bg-rose-800 text-white absolute w-full h-full [backface-visibility:hidden] [transform:rotateY(180deg)]">
                            <div class="relative w-full bg-pink-800  flex flex-col justify-start items-center gap-2">
                                <div class="p-5 h-4/5 text-base overflow-hidden"
                                    style="overflow: hidden;
                                display: -webkit-box;
                                -webkit-box-orient: vertical;
                                -webkit-line-clamp: 8;">
                                    {{ $profesor->descripcion }}
                                    <div
                                        class="absolute top-1/2 -right-3 flex flex-col justify-center items-center w-16">
                                        <svg wire:click="toggleFlip({{ $index }})"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-8 h-8 stroke-white bg-sky-500 rounded-full p-1 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                        </svg>

                                    </div>
                                </div>
                                <div class="flex h-1/5 md:hidden w-full justify-end">
                                    <div class="bg-sky-500 hover:bg-sky-600 active:bg-sky-400 group flex justify-center items-center gap-3 w-full h-full p-5 cursor-pointer"
                                        wire:click="redirectToMyRoute({{ $profesor->id }})">
                                        <span>Ver más...</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-4 h-4 text-white group-hover:animate-pulse">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="md:flex hidden h-1/5 w-full justify-end">
                                    <div class="bg-sky-500 hover:bg-sky-600 active:bg-sky-400 group flex justify-center items-center gap-3 w-full h-full p-5 cursor-pointer"
                                        wire:click="mostrarProfe({{ $profesor->id }})">
                                        <span>Ver más...</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-4 h-4 text-white group-hover:animate-pulse">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <script>
                function stopPropagation(event) {
                    event.stopPropagation();
                }
            </script>
        @endif
    </div>

    @if ($selectedProfe)
        <div class="fixed w-full h-full inset-0 bg-black/50 z-50 flex justify-center items-center px-5"
            wire:click="cerrarprofe">
            <div class="p-5 w-1/3 h-full overflow-hidden bg-amber-500 border-4 flex items-center gap-5"
                onclick="stopPropagation(event)">
                <div class="w-1/2 flex flex-col gap-3">
                    <h1 class="text-lg  uppercase text-center">{{ $selectedProfe->nombre }}</h1>
                    <div class="flex h-80 w-60 flex-col items-center justify-center">

                        <div class="flex h-72 w-60 flex-col items-center justify-center">
                            <div class="group h-full w-full [perspective:1000px]">
                                <div
                                    class="relative h-full w-full rounded-xl border-4 bg-black shadow-xl transition-all duration-500 [backface-visibility:hidden] [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
                                    <img id="btnClic" src="{{ asset(json_decode($selectedProfe->imagen)[0]) }}"
                                        alt="{{ asset(json_decode($selectedProfe->imagen)[0]) }}"
                                        class="w-full h-full object-cover bg-no-repeat rounded-xl object-top">

                                    <div
                                        class="text center absolute border-4 bg-rose-800 overflow-hidden inset-0 h-full w-full rounded-xl bg-black/40 px-12 text-slate-300 [backface-visibility:hidden] [transform:rotateY(180deg)]">
                                        <img id="otroClic" src="{{asset(json_decode($selectedProfe->imagen)[1]) }}"
                                        alt="{{ asset(json_decode($selectedProfe->imagen)[1]) }}"
                                        class="w-full h-full object-cover bg-no-repeat object-top">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-between w-full px-1">
                        <div class="font-semibold text-sm">Kills: {{ $selectedProfe->kills }}</div>
                        <div class="flex gap-1 items-center">
                            <svg fill="#000000" class="w-4 h-4" viewBox="-64 0 512 512"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path d=" M336 0H48C21.5 0 0 21.5 0 48v416c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5
                                48-48V48c0-26.5-21.5-48-48-48zM144 32h96c8.8 0 16 7.2 16 16s-7.2 16-16 16h-96c-8.8
                                0-16-7.2-16-16s7.2-16 16-16zm48 128c35.3 0 64 28.7 64 64s-28.7 64-64 64-64-28.7-64-64
                                28.7-64 64-64zm112 236.8c0 10.6-10 19.2-22.4 19.2H102.4C90 416 80 407.4 80
                                396.8v-19.2c0-31.8 30.1-57.6 67.2-57.6h5c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h5c37.1 0
                                67.2 25.8 67.2 57.6v19.2z">
                                    </path>
                                </g>
                            </svg>
                            <div class="font-semibold text-sm">{{ $posicionProfe }}/{{ $cantidadProfes }}</div>
                        </div>
                        <div class="font-semibold text-sm">Xp: {{ $selectedProfe->xp }}</div>
                    </div>
                    <div class="text-sm text-center w-full">{{ $selectedProfe->descripcion }}</div>
                    <div class="flex flex-col justify-center items-center w-full gap-1">
                        <h2 class="text-xs">Tema de entrada:</h2>
                        <div
                            class="flex flex-col gap-1 justify-center items-center bg-white px-3 py-2 rounded-xl w-full">
                            <div class="text-xs text-center">{{ basename($selectedProfe->tema) }}</div>
                            <audio class="w-full bg-transparent" src="{{ $selectedProfe->tema }}" controls="controls"  preload="none">
                            </audio>
                        </div>
                    </div>
                    <div class="flex gap-2 justify-center items-center bg-purple-700  px-2 py-2 rounded-xl w-full">
                        <div class="bg-black p-1 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 fill-purple-700">
                                <path
                                    d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                <path
                                    d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                            </svg>
                        </div>
                        <div class="text-sm overflow-y-auto max-h-40 text-yellow-400">{{ $selectedProfe->correo }}
                        </div>
                    </div>
                </div>
                <div class="w-1/2 h-full flex flex-col justify-start items-center gap-3 overflow-y-auto">
                    <div class="flex flex-col gap-1 justify-center items-center bg-sky-500 px-3 py-2 w-full mt-3"
                        style="box-shadow: -10px -10px rgba(255, 0, 0, 1);">
                        <div class="text-xs">Dificultad de materias:</div>
                        <div class="text-xs">Dificultad de clases: {{ $selectedProfe->dificultad }}</div>
                        <div class="text-xs">Dificultad de evaluaciones: {{ $selectedProfe->dificultad }}</div>
                    </div>
                    <div class="flex flex-col gap-1 justify-center items-center bg-sky-500 px-3 py-2 w-full mt-3"
                        style="box-shadow: -10px -10px rgba(255, 0, 0, 1);">
                        <div class="text-xs">Curiosidades:</div>
                        <div class="text-xs w-full text-center">{{ $selectedProfe->curiosidades }}</div>
                    </div>
                    <div class="flex flex-col gap-5 justify-center items-center  px-3 py-2 rounded-xl w-full">
                        <div class="text-xs">Tipo</div>
                        <div class="text-xs w-full flex gap-3 flex-wrap items-center justify-between">
                            @php
                                $tipos = explode(', ', $selectedProfe->tipo);
                            @endphp
                            @foreach ($tipos as $tipo)
                                <div class="bg-blue-400 px-2 py-1 rounded-xl text-sm">{{ $tipo }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 justify-center items-center px-3 py-2 rounded-xl w-full">
                        <div class="text-xs">Peligro de Reprobación:</div>
                        @php
                            $colorClasses = [
                                'extremo' => [
                                    'bg-green-500',
                                    'bg-green-500',
                                    'bg-yellow-400',
                                    'bg-yellow-400',
                                    'bg-orange-500',
                                    'bg-orange-500',
                                    'bg-red-700',
                                    'bg-red-700',
                                ],
                                'alto' => [
                                    'bg-green-500',
                                    'bg-green-500',
                                    'bg-yellow-400',
                                    'bg-yellow-400',
                                    'bg-orange-500',
                                    'bg-orange-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                ],
                                'medio' => [
                                    'bg-green-500',
                                    'bg-green-500',
                                    'bg-yellow-400',
                                    'bg-yellow-400',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                ],
                                'bajo' => [
                                    'bg-green-500',
                                    'bg-green-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                ],
                                'default' => [
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                    'bg-gray-500',
                                ],
                            ];

                            $colorClass = $colorClasses[$selectedProfe->peligro] ?? $colorClasses['default'];
                        @endphp
                        <div class="text-white text-xs">
                            {{ $selectedProfe->peligro }}
                        </div>
                        <div
                            class="w-full flex justify-center items-center gap-2 rounded-xl text-xs font-black text-center p-1 capitalize">
                            @foreach ($colorClass as $bar)
                                <div class="w-3 h-6 rounded-xl border border-black {{ $bar }}"></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex gap-1 justify-center items-start bg-sky-500 px-3 py-2 rounded-xl w-full">
                        @php
                            $clases = json_decode($selectedProfe->clases, true);
                        @endphp
                        @foreach ($clases as $tipo => $clase)
                            <div class="flex flex-col gap-2">
                                <div class="text-white text-sm">{{ ucfirst(str_replace('_', ' ', $tipo)) }}</div>
                                @if (is_array($clase))
                                    <ol class="list-disc text-center text-xs" style="list-style-position: inside;">
                                        @foreach ($clase as $clase_item)
                                            <li>{{ $clase_item }}</li>
                                        @endforeach
                                    </ol>
                                @else
                                    <div>{{ $clase }}</div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="flex flex-col justify-center items-center w-full">
                        <div class="flex flex-col gap-1 justify-center items-center bg-sky-500 px-3 py-2 w-full">
                            <div class="text-xs">Items:</div>
                            <div class="flex w-full gap-1">
                                @php
                                    $files = \Illuminate\Support\Facades\Storage::files('avatares');
                                    $avatars = array_slice($files, 0, 3);
                                @endphp
                                @foreach ($avatars as $avatar)
                                    <img src="{{ asset('storage/' . $avatar) }}" alt="item"
                                        class="w-1/3 rounded-xl max-w-full">
                                @endforeach
                            </div>
                        </div>
                        <div
                            class="flex flex-col gap-1 justify-center items-center text-white bg-purple-700 px-6 pt-0 pb-5 w-full">
                            <div class="text-xs">Atributos:</div>
                            @foreach ($atributos as $texto => $porcentaje)
                                <div class="w-full px-1 flex flex-col">
                                    <div class="text-xs pl-4">{{ $texto }}:</div>
                                    <div class="bg-fuchsia-500 w-full overflow-hidden">
                                        <div class="bg-yellow-400 text-black h-4 relative "
                                            style="width: {{ $porcentaje }}%;">
                                            @if ($porcentaje > 10)
                                                <div
                                                    class="absolute top-0 left-0 w-full h-full text-xs flex justify-center items-center ">
                                                    {{ $porcentaje }}%
                                                </div>
                                            @else
                                                <div
                                                    class="absolute top-0 left-6 h-full text-xs flex justify-end items-center pr-1">
                                                    {{ $porcentaje }}%
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex flex-col gap-1 justify-center items-center py-2 w-full">
                        <div class="text-sm text-center p-1">Suele encontrarse en los semestres:</div>
                        <div class="flex flex-wrap gap-2 justify-center items-center">
                            @for ($i = 1; $i <= 9; $i++)
                                @php
                                    $semestres = explode(', ', $selectedProfe->semestres);
                                    $textClass = '';
                                    if (in_array($i, $semestres)) {
                                        $textClass = 'text-red-600 text-xl';
                                    } else {
                                        $textClass = 'text-black text-xs'; // Color de fondo para los semestres no presentes en la base de datos
                                    }
                                @endphp
                                <div class="{{ $textClass }}">{{ $i }}</div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
