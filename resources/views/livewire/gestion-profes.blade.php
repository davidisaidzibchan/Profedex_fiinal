<div>
    <div class="flex flex-col justify-center items-center w-full">
        <div class="absolute top-14 h-14 bg-purple-600 text-white w-full py-3 px-6">
            <h1 class="text-xl font-bold">Gestión de Profesores</h1>
        </div>
        <div class="bg-gradient-to-b mt-14 py-5 from-blue-400 to-purple-600 w-full p-3 shadow-lg"
            style="min-height: calc(100vh - 3.5rem)">
            @if (session()->has('message'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 500)"
                    class="fixed z-50 inset-0 flex items-center justify-center">
                    <div class="bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow-lg">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>{{ session('message_delete') }}</span>
                        </div>
                    </div>
                </div>
            @endif
            <div class="flex justify-end mb-4">
                <button wire:click="create()" class="bg-green-500 text-white font-bold py-2 px-4 rounded">Crear
                    Profesor</button>
            </div>
            @if ($isOpen)
                <div class="fixed z-10 inset-0 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-screen">
                        <div class="fixed inset-0 bg-gray-800 opacity-75"></div>
                        <div class="bg-white mt-14 rounded-lg shadow-lg overflow-hidden max-w-lg w-full z-20">
                            <div class="p-3">
                                <h2 class="text-2xl font-bold mb-4">
                                    {{ $profesor_id ? 'Editar Usuario' : 'Crear Usuario' }}</h2>
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
                                        <label for="descripcion" class="block text-gray-700">Descripción:</label>
                                        <textarea id="descripcion" wire:model="descripcion" class="w-full px-2 py-1 border rounded-lg"></textarea>
                                        @error('descripcion')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 flex gap-2">
                                        <div class="w-1/2">
                                            <label for="nivel_edu" class="block text-gray-700">Nivel de
                                                Educación:</label>
                                            <input type="text" id="nivel_edu" wire:model="nivel_edu"
                                                class="w-full px-2 py-1 border rounded-lg">
                                            @error('nivel_edu')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="w-1/2">
                                            <label for="correo" class="block text-gray-700">Correo:</label>
                                            <input type="email" id="correo" wire:model="correo"
                                                class="w-full px-2 py-1 border rounded-lg">
                                            @error('correo')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 flex gap-2">
                                        <div class="w-1/2">
                                            <label for="kills" class="block text-gray-700">Kills:</label>
                                            <input type="number" id="kills" wire:model="kills"
                                                class="w-full px-2 py-1 border rounded-lg">
                                            @error('kills')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="w-1/2">
                                            <label for="xp" class="block text-gray-700">XP:</label>
                                            <input type="number" id="xp" wire:model="xp"
                                                class="w-full px-2 py-1 border rounded-lg">
                                            @error('xp')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-4 flex gap-2">
                                        <div class="w-1/2">
                                            <label for="dificultad" class="block text-gray-700">Dificultad:</label>
                                            <select id="dificultad" wire:model="dificultad"
                                                class="w-full px-2 py-1 border rounded-lg">
                                                <option value="">selec. Dificultad</option>
                                                <option value="facil" {{ $dificultad == 'facil' ? 'selected' : '' }}>
                                                    Facil
                                                </option>
                                                <option value="intermedio"
                                                    {{ $dificultad == 'intermedio' ? 'selected' : '' }}>Intermedio
                                                </option>
                                                <option value="dificil"
                                                    {{ $dificultad == 'dificil' ? 'selected' : '' }}>
                                                    Dificil</option>
                                            </select>
                                            @error('dificultad')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="w-1/2">
                                            <label for="peligro" class="block text-gray-700">Peligro:</label>
                                            <select id="peligro" wire:model="peligro"
                                                class="w-full px-2 py-1 border rounded-lg">
                                                <option value="">Selec. peligro</option>
                                                <option value="bajo" {{ $peligro == 'bajo' ? 'selected' : '' }}>Bajo
                                                </option>
                                                <option value="medio" {{ $peligro == 'medio' ? 'selected' : '' }}>
                                                    Medio
                                                </option>
                                                <option value="alto" {{ $peligro == 'alto' ? 'selected' : '' }}>Alto
                                                </option>
                                                <option value="extremo" {{ $peligro == 'extremo' ? 'selected' : '' }}>
                                                    Alto
                                                </option>
                                            </select>
                                            @error('peligro')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Atributos:</label>
                                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                            <div>
                                                <label for="paciencia" class="block">Paciencia:</label>
                                                <input type="range" id="paciencia" wire:model="paciencia"
                                                    min="0" max="100" class="w-full"
                                                    wire:change="$refresh">
                                                <span class="text-gray-600">{{ $paciencia }}%</span>
                                            </div>
                                            <div>
                                                <label for="inteligencia" class="block">Inteligencia:</label>
                                                <input type="range" id="inteligencia" wire:model="inteligencia"
                                                    min="0" max="100" class="w-full"
                                                    wire:change="$refresh">
                                                <span class="text-gray-600">{{ $inteligencia }}%</span>
                                            </div>
                                            <div>
                                                <label for="carisma" class="block">Carisma:</label>
                                                <input type="range" id="carisma" wire:model="carisma"
                                                    min="0" max="100" class="w-full"
                                                    wire:change="$refresh">
                                                <span class="text-gray-600">{{ $carisma }}%</span>
                                            </div>
                                            <div>
                                                <label for="tolerancia" class="block">Tolerancia:</label>
                                                <input type="range" id="tolerancia" wire:model="tolerancia"
                                                    min="0" max="100" class="w-full"
                                                    wire:change="$refresh">
                                                <span class="text-gray-600">{{ $tolerancia }}%</span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mb-4">
                                        <label for="curiosidades" class="block text-gray-700">Curiosidades:</label>
                                        <textarea id="curiosidades" wire:model="curiosidades" class="w-full px-2 py-1 border rounded-lg"></textarea>
                                        @error('curiosidades')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4 flex gap-2">
                                        <div class="w-1/2">
                                            <label for="horario" class="block text-gray-700">Horario:</label>
                                            <select id="horario" wire:model="horario"
                                                class="w-full px-2 py-1 border rounded-lg">
                                                <option value="">Selec. horario</option>
                                                <option value="matutino"
                                                    {{ $horario == 'matutino' ? 'selected' : '' }}>
                                                    Matutino</option>
                                                <option value="vespertino"
                                                    {{ $horario == 'vespertino' ? 'selected' : '' }}>Vespertino
                                                </option>
                                            </select>
                                            @error('horario')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="w-1/2">
                                            <label for="categoria" class="block text-gray-700">Categoría:</label>
                                            <select id="categoria" wire:model="categoria"
                                                class="w-full px-2 py-1 border rounded-lg">
                                                <option value="">Selec. categoría</option>
                                                <option value="común" {{ $categoria == 'común' ? 'selected' : '' }}>
                                                    Común
                                                </option>
                                                <option value="poco Común"
                                                    {{ $categoria == 'poco Común' ? 'selected' : '' }}>Poco Común
                                                </option>
                                                <option value="raro" {{ $categoria == 'raro' ? 'selected' : '' }}>
                                                    Raro
                                                </option>
                                                <option value="muy Raro"
                                                    {{ $categoria == 'muy Raro' ? 'selected' : '' }}>
                                                    Muy Raro</option>
                                                <option value="legendario"
                                                    {{ $categoria == 'legendario' ? 'selected' : '' }}>Legendario
                                                </option>
                                            </select>
                                            @error('categoria')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label for="habilidades" class="block text-gray-700">Habilidades:</label>
                                        <div class="grid grid-cols-2 gap-2">
                                            @for ($i = 0; $i < 6; $i++)
                                                <input type="text"
                                                    wire:model="habilidadesArray.{{ $i }}"
                                                    class="w-full px-2 py-1 border rounded-lg">
                                            @endfor
                                        </div>
                                        @error('habilidadesArray')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="semestres" class="block text-gray-700">Semestres:</label>
                                        <div class="flex justify-center gap-3 flex-wrap items-center space-x-2" id="semestres-container">
                                            @for ($i = 1; $i <= 9; $i++)
                                                <div>
                                                    <input type="checkbox" id="semestre{{ $i }}"
                                                        value="{{ $i }}"
                                                        wire:click="toggleSemestre({{ $i }})"
                                                        class="border rounded-lg"
                                                        @if (in_array($i, explode(',', $semestres))) checked @endif>
                                                    <label
                                                        for="semestre{{ $i }}">{{ $i }}</label>
                                                </div>
                                            @endfor
                                        </div>
                                        @error('semestres')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="clases" class="block text-gray-700">Clases:</label>
                                        <div class="flex flex-col space-y-2">
                                            <span class="text-xs">Frecuentes:</span>
                                            @for ($i = 0; $i < 3; $i++)
                                                <input class="w-full px-2 py-1 border rounded-lg" type="text"
                                                    wire:model="clases.clases_frecuentes.{{ $i }}"
                                                    placeholder="Clase Frecuente {{ $i + 1 }}">
                                            @endfor
                                            @error('clases.clases_frecuentes')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                            <span class="text-xs">Ocasionales:</span>
                                            @for ($i = 0; $i < 3; $i++)
                                                <input class="w-full px-2 py-1 border rounded-lg" type="text"
                                                    wire:model="clases.clases_ocasionales.{{ $i }}"
                                                    placeholder="Clase Ocasional {{ $i + 1 }}">
                                            @endfor
                                            @error('clases.clases_ocasionales')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-4 flex gap-2">
                                        <div class="w-1/2">
                                            <label class="block text-gray-700">Stand_User:</label>
                                            <div class=" flex flex-col gap-1">
                                                <div class="w-32 h-32 rounded-xl overflow-hidden">
                                                    @if ($imagen1)
                                                        @if ($imagen1 instanceof \Illuminate\Http\UploadedFile)
                                                            <img src="{{ $imagen1->temporaryUrl() }}" alt="Imagen 1"
                                                                class="w-full h-full object-cover mb-2">
                                                        @else
                                                            <img src="{{ asset($imagen1) }}" alt="Imagen 1"
                                                                class="w-full h-full object-cover mb-2">
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('img/image-placeholder.svg') }}"
                                                            alt="Imagen por defecto 1"
                                                            class="w-full h-full object-cover mb-2">
                                                    @endif
                                                </div>
                                                <label for="imagen1"
                                                    class="bg-amber-600 text-center w-32 px-3 py-2 text-white rounded-xl">Subir
                                                    archivo</label>
                                                <input type="file" id="imagen1" wire:model="imagen1"
                                                    class="hidden">
                                                @error('imagen1')
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="w-1/2">
                                            <label class="block text-gray-700">Stand:</label>
                                            <div class=" flex flex-col gap-1">
                                                <div class="w-32 h-32 rounded-xl overflow-hidden">
                                                    @if ($imagen2)
                                                        @if ($imagen2 instanceof \Illuminate\Http\UploadedFile)
                                                            <img src="{{ $imagen2->temporaryUrl() }}" alt="Imagen 2"
                                                                class="w-full h-full object-cover mb-2">
                                                        @else
                                                            <img src="{{ asset($imagen2) }}" alt="Imagen 1"
                                                                class="w-full h-full object-cover mb-2">
                                                        @endif
                                                    @else
                                                        <img src="{{ asset('img/image-placeholder.svg') }}"
                                                            alt="Imagen por defecto 2"
                                                            class="w-full h-full object-cover mb-2">
                                                    @endif
                                                </div>
                                                <label for="imagen2"
                                                    class="bg-amber-600 text-center w-32 px-3 py-2 text-white rounded-xl">Subir
                                                    archivo</label>
                                                <input type="file" id="imagen2" wire:model="imagen2"
                                                    class="hidden">
                                                @error('imagen2')
                                                    <span class="text-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700">Tema de entrada:</label>
                                        <div class="flex flex-col gap-1">
                                            @if ($tema)
                                                @if ($tema instanceof \Illuminate\Http\UploadedFile)
                                                    <audio controls class="w-full mb-2">
                                                        <source src="{{ asset($tema->temporaryUrl()) }}"
                                                            type="{{ $tema->getMimeType() }}">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                @else
                                                    <audio controls class="w-full mb-2">
                                                        <source src="{{ asset($tema) }}" type="audio/mpeg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                @endif
                                            @else
                                                <audio controls class="w-full mb-2">
                                                    <source src="" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            @endif
                                            <label for="tema"
                                                class="bg-amber-600 text-center w-32 px-3 py-2 text-white rounded-xl">Subir
                                                archivo</label>
                                            <input type="file" id="tema" wire:model="tema" accept="audio/*"
                                                class="hidden">
                                            @error('tema')
                                                <span class="text-red-500">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-8">
                                        <label for="tipos" class="block text-gray-700">Tipos:</label>
                                        <div class="flex flex-wrap gap-3 justify-center items-center space-x-2" id="tipos-container">
                                            @foreach ($tipos as $tipo)
                                                <div>
                                                    <input type="checkbox" id="tipo_{{ $tipo }}"
                                                        value="{{ $tipo }}"
                                                        wire:click="toggleTipo('{{ $tipo }}')"
                                                        class="border rounded-lg"
                                                        @if (in_array($tipo, $tiposSeleccionados)) checked @endif>
                                                    <label for="tipo_{{ $tipo }}">{{ $tipo }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('tiposSeleccionados')
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
                                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg"
                                        width="18" height="18" viewBox="0 0 18 18">
                                        <path d="M1 1l16 16m0-16L1 17" fill="none" stroke="#000" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                </button>
                            </div>
                            <p>¿Estás seguro de que deseas eliminar este profesor?</p>
                            <div class="mt-4 flex justify-end">
                                <button wire:click="delete()"
                                    class="px-4 py-2 bg-red-500 text-white rounded mr-2">Eliminar</button>
                                <button wire:click="closeModalConfirmation()"
                                    class="px-4 py-2 bg-gray-400 text-white rounded">Cancelar</button>
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
                            <th class="px-4 py-2 text-center">Descripción</th>
                            <th class="px-4 py-2 text-center">Nivel de Educación</th>
                            <th class="px-4 py-2 text-center">Correo</th>
                            <th class="px-4 py-2 text-center">Kills</th>
                            <th class="px-4 py-2 text-center">XP</th>
                            <th class="px-4 py-2 text-center">Dificultad</th>
                            <th class="px-4 py-2 text-center">Peligro</th>
                            <th class="px-4 py-2 text-center">Atributos</th>
                            <th class="px-4 py-2 text-center">Curiosidades</th>
                            <th class="px-4 py-2 text-center">Horario</th>
                            <th class="px-4 py-2 text-center">Categoría</th>
                            <th class="px-4 py-2 text-center">Habilidades</th>
                            <th class="px-4 py-2 text-center">Semestres</th>
                            <th class="px-4 py-2 text-center">Clases</th>
                            <th class="px-4 py-2 text-center">Stand_user</th>
                            <th class="px-4 py-2 text-center">Stand</th>
                            <th class="px-4 py-2 text-center">Tema</th>
                            <th class="px-4 py-2 text-center">Tipo</th>
                            <th class="px-4 py-2 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profesores as $index => $profesor)
                            <tr>
                                <td class="border px-4 py-2 text-center">{{ $profesor->id }}</td>
                                <td class="border px-4 py-2 text-center">{{ $profesor->nombre }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="max-h-32 overflow-y-auto">{{ $profesor->descripcion }}</div>
                                </td>
                                <td class="border px-4 py-2 text-center">{{ $profesor->nivel_edu }}</td>
                                <td class="border px-4 py-2 text-center">{{ $profesor->correo }}</td>
                                <td class="border px-4 py-2 text-center">{{ $profesor->kills }}</td>
                                <td class="border px-4 py-2 text-center">{{ $profesor->xp }}</td>
                                <td class="border px-4 py-2 text-center">{{ $profesor->dificultad }}</td>
                                <td class="border px-4 py-2 text-center">{{ $profesor->peligro }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="grid grid-cols-2 gap-2 w-52 rounded">
                                        @foreach ($profesor->atributos as $atributo => $valor)
                                            <div
                                                class="flex items-center justify-between bg-sky-100 text-blue-800 p-2 rounded-lg shadow">
                                                <span class="font-semibold">{{ ucfirst($atributo) }}:</span>
                                                <span>{{ $valor }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <div class=" w-32">
                                        {{ $profesor->curiosidades }}
                                    </div>
                                </td>
                                <td class="border px-4 py-2 text-center">{{ $profesor->horario }}</td>
                                <td class="border px-4 py-2 text-center">{{ $profesor->categoria }}</td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex flex-wrap justify-center gap-2 rounded-lg w-32">
                                        @foreach (explode(',', $profesor->habilidades) as $habilidad)
                                            <div class="bg-pink-200 px-3 py-1 rounded-full">{{ $habilidad }}</div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex flex-wrap justify-center gap-2 rounded-lg w-32">
                                        @foreach (explode(',', $profesor->semestres) as $key => $semestre)
                                            <div class="bg-emerald-200 px-3 py-1 rounded-full">{{ $semestre }}
                                            </div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    @foreach (json_decode($profesor->clases) as $key => $clase)
                                        <div
                                            class="inline-block bg-blue-100 text-blue-800 p-1 rounded-lg shadow mr-2 mb-2">
                                            <div class="font-semibold">{{ ucfirst($key) }}</div>
                                            <div>{{ implode(',', $clase) }}</div>
                                        </div>
                                    @endforeach
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="w-28 h-32">
                                        <img src="{{ asset(json_decode($profesor->imagen, true)[0]) }}"
                                            alt="Imagen1" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="border text-center">
                                    <div class="w-28 h-32">
                                        <img src="{{ asset(json_decode($profesor->imagen, true)[1]) }}"
                                            alt="Imagen 2" class="w-full h-full object-cover">
                                    </div>
                                </td>

                                <td class="border px-2 py-1 text-center">
                                    <div class="w-44">
                                        <div class="font-semibold text-xs truncate">{{ basename($profesor->tema) }}
                                        </div>
                                        <audio id="miAudio{{ $index }}" src="{{ asset($profesor->tema) }}"
                                            preload="auto"></audio>
                                        <button class="bg-blue-500 w-28 text-white px-4 py-2 rounded hover:bg-blue-700"
                                            id="audioButton{{ $index }}"
                                            onclick="toggleAudio({{ $index }})">
                                            Reproducir
                                        </button>
                                    </div>
                                </td> 
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex flex-wrap justify-center gap-2 rounded-lg w-36">
                                        @foreach (explode(',', $profesor->tipo) as $tipo)
                                            <div class="bg-red-200 px-3 py-1 rounded-full">{{ $tipo }}</div>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="border px-4 py-2 text-center">
                                    <div class="flex justify-center items-center gap-2">
                                        <button wire:click="edit({{ $profesor->id }})"
                                            class="bg-yellow-500 text-white font-bold py-2 px-4 rounded">Editar</button>
                                        <button wire:click="confirmDelete({{ $profesor->id }})"
                                            class="bg-red-500 text-white font-bold py-2 px-4 rounded">Eliminar</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        <script>
                            var currentAudio = null;
                            var currentButton = null;

                            function toggleAudio(index) {
                                var audio = document.getElementById('miAudio' + index);
                                var button = document.getElementById('audioButton' + index);

                                if (currentAudio && currentAudio !== audio) {
                                    currentAudio.pause();
                                    currentAudio.currentTime = 0;
                                    if (currentButton) {
                                        currentButton.textContent = 'Reproducir';
                                    }
                                }

                                if (audio.paused) {
                                    audio.play();
                                    button.textContent = 'Pausar';
                                    currentAudio = audio;
                                    currentButton = button;
                                } else {
                                    audio.pause();
                                    button.textContent = 'Reproducir';
                                    currentAudio = null;
                                    currentButton = null;
                                }
                            }
                        </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
