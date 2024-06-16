<div class="bg-pink-600 p-5 flex flex-col justify-start items-center min-h-screen ">
    <div class="w-full md:w-4/6 flex flex-col items-center py-2">
        <div class="p-5 w-full bg-amber-500 border-4 flex flex-col items-center gap-4">
            <h1 class="text-lg  uppercase text-center">{{ $profesor->nombre }}</h1>
            <div class="flex h-80 w-60 flex-col items-center justify-center">
                <div id="flip-card-inner-{{ $profesor->id }}" class="flip-card w-60 h-72 [perspective:1000px]">
                    <div
                        class="flip-card-inner relative w-full h-full transition-all duration-500 [transform-style:preserve-3d]">
                        <div
                            class="flip-card-front cursor-pointer inset-0 border-4 rounded-xl overflow-hidden bg-black absolute w-full h-full [backface-visibility:hidden]">
                            <img id="btnClic" src="{{ asset(json_decode($profesor->imagen)[0]) }}"
                                alt="{{ asset(json_decode($profesor->imagen)[0]) }}"
                                class="w-full h-full object-cover bg-no-repeat object-top">
                            <div class="absolute top-1/2 -left-3 flex flex-col justify-center items-center w-16">
                                <svg onclick="toggleFlip()" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-8 h-8 stroke-white bg-sky-500 rounded-full p-1 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg>
                            </div>
                        </div>
                        <div
                            class="flip-card-back cursor-pointer flex inset-0 rounded-xl overflow-hidden border-4 bg-rose-800overflow-hidden text-white absolute w-full h-full [backface-visibility:hidden] [transform:rotateY(180deg)]">
                            <img id="otroClic" src="{{ asset(json_decode($profesor->imagen)[1]) }}"
                                alt="{{ asset(json_decode($profesor->imagen)[1]) }}"
                                class="w-full h-full object-cover bg-no-repeat object-top">

                            <div class="absolute top-1/2 -right-3 flex flex-col justify-center items-center w-16">
                                <svg onclick="toggleFlip()" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-8 h-8 stroke-white bg-sky-500 rounded-full p-1 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="overlay" class="fixed inset-0 hidden pointer-events-none">
                <img id="flash" src="/img/flash.png" alt="imagen"
                    class="w-full h-full object-cover pointer-events-none animate-ping" style="">
                <img id="menacing" src="/img/menacing.png" alt="otra imagen"
                    class="absolute inset-0 w-full h-full object-contain pointer-events-none animate-ping">
            </div>
            <script>
                var flipCardInner = document.querySelector('.flip-card-inner');
                var overlay = document.getElementById("overlay");
                var menacing = document.getElementById("menacing");
                var flash = document.getElementById("flash");

                function toggleFlip() {
                    console.log('Sí puede');
                    if (flipCardInner.style.transform === "rotateY(180deg)") {
                        flipCardInner.style.transform = "";
                        overlay.classList.add("hidden");
                        menacing.classList.remove("hidden");
                        flash.classList.add("animate-ping");
                    } else {
                        flipCardInner.style.transform = "rotateY(180deg)";
                        overlay.classList.remove("hidden");
                        setTimeout(function() {
                            menacing.classList.add("hidden");
                        }, 500);
                        setTimeout(function() {
                            flash.classList.remove("animate-ping");
                        }, 200);
                    }
                }
            </script>


            <div class="flex justify-between w-full px-1">
                <div class="font-semibold text-sm">Kills: {{ $profesor->kills }}</div>
                <div class="flex gap-1 items-center">
                    <svg fill="#000000" class="w-4 h-4" viewBox="-64 0 512 512" xmlns="http://www.w3.org/2000/svg">
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
                    <div class="font-semibold text-sm">{{ $posicionProfesor }}/{{ $totalProfesores }}</div>
                </div>
                <div class="font-semibold text-sm">Xp: {{ $profesor->xp }}</div>
            </div>
            <div class="text-sm text-center w-full">{{ $profesor->descripcion }}</div>
            <div class="flex flex-col justify-center items-center w-full gap-1">
                <h2 class="text-md">Tema de entrada:</h2>
                <div class="flex flex-col gap-1 justify-center items-center bg-white px-3 py-2 rounded-xl w-full">
                    <div class="text-xs text-center">{{ basename($profesor->tema) }}</div>
                    <div class="w-full flex justify-center items-center gap-3">
                        <div class="w-1/12 text-center">
                            <!-- SVG del botón de reproducción -->
                            <svg id="playBtn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                fill="currentColor" class="w-6 h-6 cursor-pointer">
                                <path fill-rule="evenodd"
                                    d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div id="waveform" class="w-11/12">
                        </div>
                    </div>
                </div>
                <script>
                    const playBtn = document.getElementById("playBtn");
                    const wavesurfer = WaveSurfer.create({
                        container: '#waveform',
                        waveColor: '#000000',
                        progressColor: '#0000ff',
                        url: '{{ asset($profesor->tema) }}',
                        responsive: true,
                        height: 30,
                        barWidth: 4,
                        barHeight: 2,
                        barRadius: 4,
                    });

                    // Variable para rastrear el estado del reproductor de audio
                    let isPlaying = false;

                    // Función para cambiar el estado de reproducción del audio y el SVG del botón de reproducción
                    function togglePlay() {
                        if (isPlaying) {
                            wavesurfer.pause();
                            // Cambiar el SVG del botón de reproducción a play
                            playBtn.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 cursor-pointer">
                                    <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                                </svg>`;
                        } else {
                            wavesurfer.play();
                            // Cambiar el SVG del botón de reproducción a pause
                            playBtn.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 cursor-pointer">
                                    <path fill-rule="evenodd" d="M6.75 5.25a.75.75 0 0 1 .75-.75H9a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H7.5a.75.75 0 0 1-.75-.75V5.25Zm7.5 0A.75.75 0 0 1 15 4.5h1.5a.75.75 0 0 1 .75.75v13.5a.75.75 0 0 1-.75.75H15a.75.75 0 0 1-.75-.75V5.25Z" clip-rule="evenodd" />
                                </svg>`;
                        }
                        // Cambiar el estado del reproductor de audio
                        isPlaying = !isPlaying;
                    }

                    // Asignar el evento click al botón de reproducción
                    playBtn.addEventListener('click', togglePlay);

                    // Asignar el evento finish al reproductor de audio para cambiar el ícono al de play cuando la reproducción se complete
                    wavesurfer.on('finish', function() {
                        // Cambiar el SVG del botón de reproducción a play
                        playBtn.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 cursor-pointer">
                                <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                            </svg>`;
                        // Actualizar el estado del reproductor de audio
                        isPlaying = false;
                    });
                    Livewire.on('scriptLoaded', function() {
                        wavesurfer.load('{{ $profesor->tema }}');
                    });
                </script>
            </div>
            <div class="flex flex-col gap-1 justify-center items-center bg-sky-500 px-3 py-2 w-full mt-3"
                style="box-shadow: -10px -10px rgba(255, 0, 0, 1);">
                <div class="text-md">Dificultad de materias:</div>
                <div class="text-xs">Dificultad de clases: {{ $profesor->dificultad }}</div>
                <div class="text-xs">Dificultad de evaluaciones: {{ $profesor->dificultad }}</div>
            </div>
            <div class="flex flex-col gap-1 justify-center items-center px-3 py-2 rounded-xl w-full">
                <div class="text-md">Peligro de Reprobación:</div>
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

                    $colorClass = $colorClasses[$profesor->peligro] ?? $colorClasses['default'];
                @endphp
                <div class="text-white text-md">
                    {{ $profesor->peligro }}
                </div>
                <div
                    class="w-full flex justify-center items-center gap-2 rounded-xl text-md font-black text-center p-1 capitalize">
                    @foreach ($colorClass as $bar)
                        <div class="w-3 h-6 rounded-xl border border-black {{ $bar }}"></div>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col gap-1 justify-center items-center bg-sky-500 px-3 py-2 w-full mt-3"
                style="box-shadow: -10px -10px rgba(255, 0, 0, 1);">
                <div class="text-md">Curiosidades:</div>
                <div class="text-xs w-full text-center">{{ $profesor->curiosidades }}</div>
            </div>
            <div class="flex flex-col justify-center items-center w-full">
                <div class="flex flex-col gap-1 justify-center items-center bg-sky-500 px-3 py-2 w-full">
                    <div class="text-md">Items:</div>
                    <div class="flex w-full gap-1">
                        @php
                        $files = \Illuminate\Support\Facades\Storage::files('avatares');
                        $avatars = array_slice($files, 0, 3);
                    @endphp
                    @foreach ($avatars as $avatar)
                        <img src="{{ asset('storage/'.$avatar) }}" alt="item" class="w-1/3 rounded-xl max-w-full">
                    @endforeach
                    </div>
                </div>
                <div
                    class="flex flex-col gap-1 justify-center items-center text-white bg-purple-700 px-6 pt-0 pb-5 w-full">
                    <div class="text-md">Atributos:</div>
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
            <div class="flex flex-col gap-5 justify-center items-center  px-3 py-2 rounded-xl w-full">
                <div class="text-md">Tipo</div>
                <div class="text-xs w-full flex flex-wrap items-center justify-between">
                    @php
                        $tipos = explode(', ', $profesor->tipo);
                    @endphp
                    @foreach ($tipos as $tipo)
                        <div class="bg-blue-400 px-2 py-1 rounded-xl text-sm">{{ $tipo }}</div>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col gap-1 justify-center items-center bg-sky-500 px-3 py-2 rounded-xl w-full">
                @php
                    $clases = json_decode($profesor->clases, true);
                @endphp
                @foreach ($clases as $tipo => $clase)
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
                @endforeach
            </div>

            <div class="flex gap-1 justify-center items-start bg-sky-500 px-3 py-2 rounded-xl w-full">
                <div class="w-2/5 flex flex-col gap-4">
                    <div>
                        <div class="text-sm text-center p-1 text-white">Horario:</div>
                        <div class="text-xs w-full text-center">{{ $profesor->horario }}</div>
                    </div>
                    <div>
                        <div class="text-sm text-center p-1 text-white">categoria:</div>
                        <div class="text-xs w-full text-center">{{ $profesor->categoria }}</div>
                    </div>
                </div>
                <div class="w-3/5">
                    <div class="text-sm text-center p-1 text-white">Habilidades:</div>
                    @php
                        $habilidades = explode(', ', $profesor->habilidades);
                    @endphp
                    <div class="flex flex-col items-center">
                        <ol class="list-disc text-xs text-left">
                            @foreach ($habilidades as $habilidad)
                                <li>{{ $habilidad }}</li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-1 justify-center items-center py-2 w-full">
                <div class="text-sm text-center p-1">Suele encontrarse en los semestres:</div>
                <div class="flex flex-wrap gap-2 justify-center items-center">
                    @for ($i = 1; $i <= 9; $i++)
                        @php
                            $semestres = explode(', ', $profesor->semestres);
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
                <div class="text-sm overflow-y-auto max-h-40 text-yellow-400">{{ $profesor->correo }}</div>
            </div>
        </div>
    </div>
</div>
