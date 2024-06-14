<div class="flex flex-col items-center justify-start gap-3 mb-5 ">
    <div class="w-full p-2 bg-amber-500 ">
        <div class="w-full px-5 mb-4 md:text-center">
            <div class="text-base font-semibold">Comparte tu sabiduria o experiencia con los novatos.</div>
            
        </div>
    </div>
    @if ($errors->any() || session()->has('error') || session()->has('success'))
        <div class="text-sm bg-white rounded-xl p-2">
            @if ($errors->any())
                <span class="text-red-600">{{ $errors->first() }}</span>
            @elseif (session()->has('error'))
                <span class="text-red-600">{{ session('error') }}</span>
            @elseif (session()->has('success'))
                <span class="text-green-600">{{ session('success') }}</span>
            @endif
        </div>
    @endif
    @if ($malaPalabra)
        <div class="text-sm bg-white rounded-xl p-2">
            <p class="text-red-600">{{ $malaPalabra }}</p>
        </div>
    @endif
    <div class="w-full md:w-2/3 flex flex-col items-center p-2">
        <div class="w-full md:hidden bg-amber-500 rounded-xl flex flex-col items-center gap-3 md:p-10 p-2">
            <div class="relative w-full">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 stroke-neutral-400" viewBox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M6 21L7.5 15M18 21L16.5 15M16.5 15L14 5C14 5 13.5 3 12 3C10.5 3 10 5 10 5L7.5 15M16.5 15H7.5"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                    </svg>
                </span>
                <input placeholder="Agregale un titulo a tu anecdota " wire:model="titulo" wire:input="$refresh"
                    class="pl-10 w-full bg-white border text-sm border-black text-black rounded-xl">
            </div>
            <div class="relative w-full">
                <span class="absolute top-2 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 fill-neutral-400">
                        <path
                            d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                        <path
                            d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                    </svg>

                </span>
                <textarea placeholder="Escribe tu consejo..." name="" id="" cols="30" rows="8"
                    wire:model="consejo" wire:input="$refresh" wire:keyup="actualizarConsejo()"
                    class="pl-10 w-full bg-white border text-sm border-black text-black rounded-xl"></textarea>
                @if ($malaPalabra)
                    <p class="text-red-600">{{ $malaPalabra }}</p>
                @endif
            </div>
            <div class="flex gap-2">
                <div class="relative w-1/2">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-5 h-5 fill-neutral-400">
                            <path fill-rule="evenodd"
                                d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                clip-rule="evenodd" />
                            <path
                                d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                        </svg>

                    </span>
                    <select name="semestre" id="semestre" wire:model="semestre" wire:input="$refresh"
                        class="pl-10 w-full bg-white border text-sm border-black text-black rounded-xl">
                        <option value="" class="bg-red-400 text-white">Semestre</option>
                        <option value="primer semestre">Primer semestre</option>
                        <option value="segundo semestre">Segundo semestre</option>
                        <option value="tercer semestre">Tercer semestre</option>
                        <option value="cuarto semestre">Cuarto semestre</option>
                        <option value="quinto semestre">Quinto semestre</option>
                        <option value="sexto semestre">Sexto semestre</option>
                        <option value="septimo semestre">Septimo semestre</option>
                        <option value="octavo semestre">Octavo semestre</option>
                        <option value="noveno semestre">Noveno semestre</option>
                    </select>
                </div>
                <div class="relative w-1/2">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 fill-neutral-400" version="1.1" id="Capa_1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 489.38 489.38" xml:space="preserve">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <g id="XMLID_129_">
                                    <path id="XMLID_134_"
                                        d="M473.725,5.656H213.576c-8.655,0-15.655,7.022-15.655,15.664v110.484l11.319-13.234 c5.375-6.292,12.461-10.172,19.992-11.793V36.978h228.836v204.531H229.233v-34.238l-7.05,8.244 c-6.161,7.189-14.858,11.65-24.262,12.529v29.124c0,8.642,7,15.655,15.655,15.655h84.489L255.141,467.7 c-1.923,8.739,3.6,17.382,12.346,19.31c8.667,1.904,17.382-3.601,19.287-12.331l44.457-201.855h25.844l44.457,201.855 c1.666,7.557,8.369,12.714,15.803,12.705c1.154,0,2.334-0.117,3.502-0.374c8.746-1.928,14.268-10.57,12.328-19.31l-42.92-194.877 h83.481c8.647,0,15.655-7.013,15.655-15.655V21.32C489.38,12.678,482.372,5.656,473.725,5.656z">
                                    </path>
                                    <path id="XMLID_132_"
                                        d="M349.368,97.116c-1.234-3.11-4.732-4.637-7.84-3.406l-92.234,32.555 c-8.465-6.554-20.678-5.383-27.737,2.827l-29.267,34.178l-25.951-22.245c0.171,1.837,0.56,3.622,0.56,5.507v48.291l14.438,12.371 c8.568,7.338,21.385,6.204,28.549-2.198l34.842-40.743l28.1-16.439l73.951-43.267C349.336,103.073,350.469,99.923,349.368,97.116z">
                                    </path>
                                    <path id="XMLID_131_"
                                        d="M109.928,105.776H92.547c-13.308,0-25.01,6.468-32.448,16.327l-53.352,49.12 c-8.313,7.405-9.067,20.232-1.581,28.595l43.528,48.585c7.421,8.309,20.267,9.044,28.579,1.576 c8.334-7.469,9.038-20.262,1.57-28.586l-30.003-33.504l42.616-38.134l-24.82,33.721l24.279,27.107 c13.416,14.992,12.151,38.027-2.834,51.453c-10.231,9.172-24.193,11.324-36.297,7.094c0,0,0.188,93.659,0.188,193.962 c0,13.416,10.874,24.291,24.291,24.291c13.403,0,24.291-10.875,24.291-24.291c0-100.272,0-43.051,0-144.771h16.203 c0,101.646,0,44.468,0,144.771c0,7.004-1.953,13.49-5.067,19.231c4.076,3.135,9.148,5.06,14.676,5.06 c13.424,0,24.298-10.875,24.298-24.291c0-100.272,0.031-58.237,0.031-316.561C150.697,124.022,132.45,105.776,109.928,105.776z">
                                    </path>
                                    <path id="XMLID_130_"
                                        d="M79.592,91.198c6.495,3.376,13.787,5.471,21.62,5.471c7.853,0,15.145-2.095,21.659-5.477 c15.204-7.877,25.684-23.559,25.684-41.862c0-26.146-21.196-47.335-47.344-47.335c-26.144,0-47.335,21.189-47.335,47.335 C53.877,67.643,64.368,83.331,79.592,91.198z">
                                    </path>
                                </g>
                            </g>
                        </svg>
                    </span>
                    <select name="profesor" id="profesor" wire:model="idProfesor" wire:input="$refresh"
                        class="pl-10 w-full bg-white border text-sm border-black text-black rounded-xl flex">
                        <option value="" class="bg-red-400 text-white">Profesor</option>
                        @foreach ($profesores as $profesor)
                            <option value="{{ $profesor->id }}">{{ $profesor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="relative w-full">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                        class="w-5 h-5 fill-neutral-400">
                        <path
                            d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
                    </svg>

                </span>
                <select name="materia" id="materia" wire:model="idMateria" wire:input="$refresh"
                    class="pl-10 w-full bg-white border text-sm border-black text-black rounded-xl">
                    <option value="" class="bg-red-400 text-white">Materia</option>
                    @foreach ($materias as $materia)
                        <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="w-full">
                <div
                    class="flex flex-col w-full bg-white border text-sm border-black text-black rounded-xl overflow-hidden">
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 fill-neutral-400">
                                <path fill-rule="evenodd"
                                    d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <div class="pl-10 p-2 w-full bg-white text-neutral-400 text-sm rounded-xl">Etiquetas
                        </div>
                    </div>
                    <div class="px-5 py-2 w-full flex flex-col gap-5 justify-center items-center"
                        wire:input="$refresh">
                        <div class="flex flex-wrap gap-2 justify-center items-center">
                            <label for="salvasemestres"
                                class="bg-orange-300 p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                <div class="font-semibold text-sm">#salvasemestres</div>
                                <input id="salvasemestres" type="checkbox" name="etiquetas[]"
                                    value="#salvasemestres" wire:model="etiquetas"
                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                            </label>
                            <label for="hack"
                                class="bg-fuchsia-400 p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                <div class="font-semibold text-sm">#hack</div>
                                <input id="hack" type="checkbox" name="etiquetas[]" value="#hack"
                                    wire:model="etiquetas"
                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                            </label>
                            <label for="chismesito"
                                class="bg-rose-300 p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                <div class="font-semibold text-sm">#chismesito</div>
                                <input id="chismesito" type="checkbox" name="etiquetas[]" value="#chismesito"
                                    wire:model="etiquetas"
                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                            </label>
                            <label for="util"
                                class="bg-blue-400 p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                <div class="font-semibold text-sm">#útil</div>
                                <input id="util" type="checkbox" name="etiquetas[]" value="#útil"
                                    wire:model="etiquetas"
                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                            </label>
                            <label for="hate"
                                class="bg-lime-300 p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                <div class="font-semibold text-sm">#hate</div>
                                <input id="hate" type="checkbox" name="etiquetas[]" value="#hate"
                                    wire:model="etiquetas"
                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                            </label>
                            <label for="microconsejo"
                                class="bg-yellow-300 p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                <div class="font-semibold text-sm">#microconsejo</div>
                                <input id="microconsejo" type="checkbox" name="etiquetas[]" value="#microconsejo"
                                    wire:model="etiquetas"
                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                            </label>
                            @php
                                $colors = [
                                    'bg-orange-300',
                                    'bg-fuchsia-400',
                                    'bg-rose-300',
                                    'bg-blue-400',
                                    'bg-lime-300',
                                    'bg-yellow-300',
                                    // Añade más clases de colores aquí
                                ];
                                $colorCount = count($colors);
                            @endphp
                            @foreach ($etiquetasPersonalizadas as $index => $tagCustom)
                                @php
                                    $colorClass = $colors[$index % $colorCount];
                                @endphp
                                <label for="{{ $tagCustom }}"
                                    class="{{ $colorClass }} p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                    <div class="font-semibold text-sm">{{ $tagCustom }}</div>
                                    <input id="{{ $tagCustom }}" type="checkbox" name="etiquetas[]"
                                        value="{{ $tagCustom }}" wire:model="etiquetas"
                                        class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                </label>
                            @endforeach
                        </div>
                        <div class="w-full overflow-hidden flex gap-2 items-center justify-center text-sm">

                            <div class="w-3/5 flex justify-center items-center">
                                <div class="pr-3">otro:</div>
                                <div>#</div>
                                <input placeholder="miEtiqueta" type="text" name="etiquetas[]"
                                    wire:model="otraEtiqueta"
                                    class="text-sm bg-transparent w-full p-0 border-0 border-b-2 focus:ring-0">
                            </div>
                            <button wire:click="agregarNuevaEtiqueta"
                                class="w-2/5 bg-green-500 hover:bg-green-400 active:bg-green-600 font-bold py-1 px-3 rounded-xl inline-flex justify-center gap-1 items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Agregar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full p-2">
                <div class="flex justify-center gap-1 items-center w-full text-sm text-black overflow-hidden">
                    <div
                        class="px-5 w-1/3 py-2 flex flex-wrap justify-center items-center gap-2 bg-white rounded-xl border border-black">
                        <div class="text-sm">Anónimo</div>
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input id="switch" type="checkbox" class="peer sr-only" wire:model="esAnonimo" />
                            <label for="switch" class="hidden"></label>
                            <div
                                class="peer h-6 w-11 rounded-full border bg-slate-200 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-green-300">
                            </div>
                        </label>
                    </div>
                    <button wire:click="crearConsejo(false)" onclick="scrollToTop()"
                        class=" w-1/3 bg-sky-400 font-semibold border border-black hover:bg-blue-500 active:bg-blue-300 py-2 px-4 rounded-xl"
                        type="button">Guardar</button>
                    <button wire:click="crearConsejo(true)" onclick="scrollToTop()"
                        class=" w-1/3 bg-sky-400 font-semibold border border-black hover:bg-blue-500 active:bg-blue-300 py-2 px-4 rounded-xl"
                        type="button">Publicar</button>
                </div>
            </div>
        </div>

        <div class="w-full bg-amber-500 md:flex flex-col hidden items-center gap-3 md:p-10 p-2">
            <div class="flex gap-3">
                <div class="w-1/2 flex flex-col gap-2">
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 stroke-neutral-400" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M6 21L7.5 15M18 21L16.5 15M16.5 15L14 5C14 5 13.5 3 12 3C10.5 3 10 5 10 5L7.5 15M16.5 15H7.5"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </g>
                            </svg>
                        </span>
                        <input placeholder="Agregale un titulo a tu anecdota " wire:model="titulo"
                            wire:input="$refresh"
                            class="pl-10 w-full bg-white border text-sm border-black text-black ">
                    </div>
                    <div class="relative w-full">
                        <span class="absolute top-2 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 fill-neutral-400">
                                <path
                                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path
                                    d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg>
                        </span>
                        <textarea placeholder="Escribe tu consejo..." name="" id="" cols="30" rows="13"
                            wire:model="consejo" wire:input="$refresh" wire:keyup="actualizarConsejo()"
                            class="pl-10 w-full bg-white border text-sm border-black text-black  h-full resize-none border-none outline-none overflow-hidden"></textarea>

                    </div>
                </div>
                <div class="w-1/2 flex flex-col gap-2">
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 fill-neutral-400">
                                <path fill-rule="evenodd"
                                    d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                            </svg>

                        </span>
                        <select name="semestre" id="semestre" wire:model="semestre" wire:input="$refresh"
                            class="pl-10 w-full bg-white border text-sm border-black text-black ">
                            <option value="" class="bg-red-400 text-white">Semestre</option>
                            <option value="primer semestre">Primer semestre</option>
                            <option value="segundo semestre">Segundo semestre</option>
                            <option value="tercer semestre">Tercer semestre</option>
                            <option value="cuarto semestre">Cuarto semestre</option>
                            <option value="quinto semestre">Quinto semestre</option>
                            <option value="sexto semestre">Sexto semestre</option>
                            <option value="septimo semestre">Septimo semestre</option>
                            <option value="octavo semestre">Octavo semestre</option>
                            <option value="noveno semestre">Noveno semestre</option>
                        </select>
                    </div>
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="w-5 h-5 fill-neutral-400" version="1.1" id="Capa_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 489.38 489.38" xml:space="preserve">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g id="XMLID_129_">
                                        <path id="XMLID_134_"
                                            d="M473.725,5.656H213.576c-8.655,0-15.655,7.022-15.655,15.664v110.484l11.319-13.234 c5.375-6.292,12.461-10.172,19.992-11.793V36.978h228.836v204.531H229.233v-34.238l-7.05,8.244 c-6.161,7.189-14.858,11.65-24.262,12.529v29.124c0,8.642,7,15.655,15.655,15.655h84.489L255.141,467.7 c-1.923,8.739,3.6,17.382,12.346,19.31c8.667,1.904,17.382-3.601,19.287-12.331l44.457-201.855h25.844l44.457,201.855 c1.666,7.557,8.369,12.714,15.803,12.705c1.154,0,2.334-0.117,3.502-0.374c8.746-1.928,14.268-10.57,12.328-19.31l-42.92-194.877 h83.481c8.647,0,15.655-7.013,15.655-15.655V21.32C489.38,12.678,482.372,5.656,473.725,5.656z">
                                        </path>
                                        <path id="XMLID_132_"
                                            d="M349.368,97.116c-1.234-3.11-4.732-4.637-7.84-3.406l-92.234,32.555 c-8.465-6.554-20.678-5.383-27.737,2.827l-29.267,34.178l-25.951-22.245c0.171,1.837,0.56,3.622,0.56,5.507v48.291l14.438,12.371 c8.568,7.338,21.385,6.204,28.549-2.198l34.842-40.743l28.1-16.439l73.951-43.267C349.336,103.073,350.469,99.923,349.368,97.116z">
                                        </path>
                                        <path id="XMLID_131_"
                                            d="M109.928,105.776H92.547c-13.308,0-25.01,6.468-32.448,16.327l-53.352,49.12 c-8.313,7.405-9.067,20.232-1.581,28.595l43.528,48.585c7.421,8.309,20.267,9.044,28.579,1.576 c8.334-7.469,9.038-20.262,1.57-28.586l-30.003-33.504l42.616-38.134l-24.82,33.721l24.279,27.107 c13.416,14.992,12.151,38.027-2.834,51.453c-10.231,9.172-24.193,11.324-36.297,7.094c0,0,0.188,93.659,0.188,193.962 c0,13.416,10.874,24.291,24.291,24.291c13.403,0,24.291-10.875,24.291-24.291c0-100.272,0-43.051,0-144.771h16.203 c0,101.646,0,44.468,0,144.771c0,7.004-1.953,13.49-5.067,19.231c4.076,3.135,9.148,5.06,14.676,5.06 c13.424,0,24.298-10.875,24.298-24.291c0-100.272,0.031-58.237,0.031-316.561C150.697,124.022,132.45,105.776,109.928,105.776z">
                                        </path>
                                        <path id="XMLID_130_"
                                            d="M79.592,91.198c6.495,3.376,13.787,5.471,21.62,5.471c7.853,0,15.145-2.095,21.659-5.477 c15.204-7.877,25.684-23.559,25.684-41.862c0-26.146-21.196-47.335-47.344-47.335c-26.144,0-47.335,21.189-47.335,47.335 C53.877,67.643,64.368,83.331,79.592,91.198z">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </span>
                        <select name="profesor" id="profesor" wire:model="idProfesor" wire:input="$refresh"
                            class="pl-10 w-full bg-white border text-sm border-black text-black  flex">
                            <option value="" class="bg-red-400 text-white">Profesor</option>
                            @foreach ($profesores as $profesor)
                                <option value="{{ $profesor->id }}">{{ $profesor->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative w-full">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="w-5 h-5 fill-neutral-400">
                                <path
                                    d="M11.25 4.533A9.707 9.707 0 0 0 6 3a9.735 9.735 0 0 0-3.25.555.75.75 0 0 0-.5.707v14.25a.75.75 0 0 0 1 .707A8.237 8.237 0 0 1 6 18.75c1.995 0 3.823.707 5.25 1.886V4.533ZM12.75 20.636A8.214 8.214 0 0 1 18 18.75c.966 0 1.89.166 2.75.47a.75.75 0 0 0 1-.708V4.262a.75.75 0 0 0-.5-.707A9.735 9.735 0 0 0 18 3a9.707 9.707 0 0 0-5.25 1.533v16.103Z" />
                            </svg>
                        </span>
                        <select name="materia" id="materia" wire:model="idMateria" wire:input="$refresh"
                            class="pl-10 w-full bg-white border text-sm border-black text-black ">
                            <option value="" class="bg-red-400 text-white">Materia</option>
                            @foreach ($materias as $materia)
                                <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <div
                            class="flex flex-col w-full bg-white border text-sm border-black text-black  overflow-hidden">
                            <div class="relative w-full">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-5 h-5 fill-neutral-400">
                                        <path fill-rule="evenodd"
                                            d="M5.25 2.25a3 3 0 0 0-3 3v4.318a3 3 0 0 0 .879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 0 0 5.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 0 0-2.122-.879H5.25ZM6.375 7.5a1.125 1.125 0 1 0 0-2.25 1.125 1.125 0 0 0 0 2.25Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <div class="pl-10 p-2 w-full bg-white text-neutral-400 text-sm ">Etiquetas
                                </div>
                            </div>
                            <div class="px-5 py-2 w-full flex flex-col gap-5 justify-center items-center"
                                wire:input="$refresh">
                                <div class="flex flex-wrap gap-2 justify-center items-center">
                                    <label for="salvasemestres"
                                        class="bg-orange-300 p-2  cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                        <div class="font-semibold text-sm">#salvasemestres</div>
                                        <input id="salvasemestres" type="checkbox" name="etiquetas[]"
                                            value="#salvasemestres" wire:model="etiquetas"
                                            class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                    </label>
                                    <label for="hack"
                                        class="bg-fuchsia-400 p-2  cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                        <div class="font-semibold text-sm">#hack</div>
                                        <input id="hack" type="checkbox" name="etiquetas[]" value="#hack"
                                            wire:model="etiquetas"
                                            class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                    </label>
                                    <label for="chismesito"
                                        class="bg-rose-300 p-2  cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                        <div class="font-semibold text-sm">#chismesito</div>
                                        <input id="chismesito" type="checkbox" name="etiquetas[]"
                                            value="#chismesito" wire:model="etiquetas"
                                            class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                    </label>
                                    <label for="util"
                                        class="bg-blue-400 p-2  cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                        <div class="font-semibold text-sm">#útil</div>
                                        <input id="util" type="checkbox" name="etiquetas[]" value="#útil"
                                            wire:model="etiquetas"
                                            class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                    </label>
                                    <label for="hate"
                                        class="bg-lime-300 p-2  cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                        <div class="font-semibold text-sm">#hate</div>
                                        <input id="hate" type="checkbox" name="etiquetas[]" value="#hate"
                                            wire:model="etiquetas"
                                            class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                    </label>
                                    <label for="microconsejo"
                                        class="bg-yellow-300 p-2  cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                        <div class="font-semibold text-sm">#microconsejo</div>
                                        <input id="microconsejo" type="checkbox" name="etiquetas[]"
                                            value="#microconsejo" wire:model="etiquetas"
                                            class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                    </label>
                                    @php
                                        $colors = [
                                            'bg-orange-300',
                                            'bg-fuchsia-400',
                                            'bg-rose-300',
                                            'bg-blue-400',
                                            'bg-lime-300',
                                            'bg-yellow-300',
                                            // Añade más clases de colores aquí
                                        ];
                                        $colorCount = count($colors);
                                    @endphp
                                    @foreach ($etiquetasPersonalizadas as $index => $tagCustom)
                                        @php
                                            $colorClass = $colors[$index % $colorCount];
                                        @endphp
                                        <label for="{{ $tagCustom }}"
                                            class="{{ $colorClass }} p-2  cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                            <div class="font-semibold text-sm">{{ $tagCustom }}</div>
                                            <input id="{{ $tagCustom }}" type="checkbox" name="etiquetas[]"
                                                value="{{ $tagCustom }}" wire:model="etiquetas"
                                                class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                        </label>
                                    @endforeach
                                </div>
                                <div class="w-full overflow-hidden flex gap-2 items-center justify-center text-sm">

                                    <div class="w-3/5 flex justify-center items-center">
                                        <div class="pr-3">otro:</div>
                                        <div>#</div>
                                        <input placeholder="miEtiqueta" type="text" name="etiquetas[]"
                                            wire:model="otraEtiqueta"
                                            class="text-sm bg-transparent w-full p-0 border-0 border-b-2 focus:ring-0">
                                    </div>
                                    <button wire:click="agregarNuevaEtiqueta"
                                        class="w-2/5 bg-green-500 hover:bg-green-400 active:bg-green-600 font-bold py-1 px-3  inline-flex justify-center gap-1 items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                        <span>Agregar</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full p-2 px-8">
                <div class="flex justify-between gap-1 items-center w-full text-sm text-black overflow-hidden">
                    <div
                        class="px-5 py-2 flex flex-wrap justify-center items-center gap-2 bg-white  border border-black">
                        <div class="text-sm">Anónimo</div>
                        <label class="relative inline-flex cursor-pointer items-center">
                            <input id="switch" type="checkbox" class="peer sr-only" wire:model="esAnonimo" />
                            <label for="switch" class="hidden"></label>
                            <div
                                class="peer h-6 w-11 rounded-full border bg-slate-200 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-green-300">
                            </div>
                        </label>
                    </div>
                    <div>
                        <button wire:click="crearConsejo(false)" onclick="scrollToTop()"
                            class=" bg-sky-400 font-semibold border border-black hover:bg-blue-500 active:bg-blue-300 py-2 px-4 "
                            type="button">Guardar</button>
                        <button wire:click="crearConsejo(true)" onclick="scrollToTop()"
                            class="bg-sky-400 font-semibold border border-black hover:bg-blue-500 active:bg-blue-300 py-2 px-4 "
                            type="button">Publicar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="notification-overlay"
        class="fixed justify-center items-center top-0 left-0 w-full h-full bg-black bg-opacity-50 z-50 hidden ease-in-out transition-opacity duration-500">
        <div class="flex flex-col justify-center items-center h-full p-5">
            <div class="w-full bg-yellow-400 p-3 rounded-xl min-h-60 flex flex-col gap-2 justify-center items-center">
                <div class="text-center font-bold text-xl">Tu consejo ha sido
                    enviado con éxito!</div>
                <div class="text-center text-sm font-semibold">Espera su aprobación</div>
                <svg class="w-12 h-12" fill="#000000" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="m12 1.316c-5.901 0-10.684 4.783-10.684 10.684s4.783 10.684 10.684 10.684 10.684-4.783 10.684-10.684c-.012-5.896-4.788-10.672-10.683-10.684h-.001zm0 22.297c-6.414 0-11.613-5.199-11.613-11.613s5.199-11.613 11.613-11.613 11.613 5.199 11.613 11.613v.015c0 6.405-5.192 11.597-11.597 11.597-.005 0-.011 0-.016 0h.001z">
                        </path>
                        <path
                            d="m12 24c-6.614-.034-11.966-5.386-12-11.997v-.003c0-6.627 5.373-12 12-12s12 5.373 12 12c-.034 6.614-5.386 11.966-11.997 12zm0-23.226c-6.2 0-11.226 5.026-11.226 11.226s5.026 11.226 11.226 11.226 11.226-5.026 11.226-11.226c-.004-6.198-5.028-11.221-11.225-11.226zm0 22.297c-6.114 0-11.071-4.957-11.071-11.071s4.957-11.071 11.071-11.071c6.114 0 11.071 4.957 11.071 11.071s-4.957 11.071-11.071 11.071zm0-21.368c-5.687 0-10.297 4.61-10.297 10.297s4.61 10.297 10.297 10.297 10.297-4.61 10.297-10.297c0-.001 0-.003 0-.005 0-5.684-4.608-10.292-10.292-10.292-.002 0-.003 0-.005 0z">
                        </path>
                        <path
                            d="m9.677 9.91v.009c0 1.15-.932 2.082-2.082 2.082-.003 0-.006 0-.009 0-1.154 0-2.09-.936-2.09-2.09s.936-2.09 2.09-2.09 2.09.936 2.09 2.09z">
                        </path>
                        <path
                            d="m12 19.665c-.257 0-.465-.208-.465-.465s.208-.465.465-.465h.011c3.038 0 5.619-1.954 6.555-4.674l.015-.049c.052-.189.223-.325.425-.325.042 0 .082.006.12.017l-.003-.001c.189.052.325.223.325.425 0 .042-.006.082-.016.12l.001-.003c-1.041 3.17-3.974 5.419-7.432 5.419z">
                        </path>
                        <path
                            d="m12 20.052c-.469-.004-.847-.383-.852-.851.032-.457.395-.82.849-.851h.003.076c2.855 0 5.275-1.866 6.105-4.445l.013-.045c.065-.203.203-.366.383-.462l.004-.002c.119-.065.26-.103.411-.103.074 0 .146.009.215.027l-.006-.001c.345.108.592.425.592.8 0 .102-.018.199-.051.29l.002-.006c-1.058 3.303-4.101 5.652-7.692 5.652-.017 0-.035 0-.052 0h.003zm0-.852c-.02.02-.033.047-.033.077s.013.058.033.077h.017c3.266 0 6.037-2.119 7.014-5.058l.015-.052v-.077h-.077c-.992 2.947-3.729 5.032-6.954 5.032-.005 0-.009 0-.014 0h.001z">
                        </path>
                        <path
                            d="m17.961 10.142h-1.703l.697-.542c.133-.112.218-.278.218-.465 0-.334-.271-.605-.605-.605-.148 0-.283.053-.388.141l.001-.001-2.013 1.548c-.09.112-.168.239-.228.376l-.004.011v.155c.03.306.285.542.596.542h.025-.001 3.406.009c.337 0 .611-.273.611-.611 0-.003 0-.006 0-.009-.03-.306-.285-.542-.596-.542-.008 0-.017 0-.025 0h.001z">
                        </path>
                    </g>
                </svg>
            </div>
        </div>
    </div>
    <script>
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        document.addEventListener('livewire:initialized', () => {
            @this.on('show-notification', (event) => {
                var notification = document.getElementById('notification-overlay');
                setTimeout(() => {
                    notification.classList.add('flex');
                    notification.classList.remove('hidden');
                }, 100);
                setTimeout(() => {
                    notification.classList.add('hidden');
                    notification.classList.remove('flex');
                }, 1000);
            })
        });
    </script>
</div>
