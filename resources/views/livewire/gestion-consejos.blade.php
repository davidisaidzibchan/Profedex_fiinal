<div class="flex flex-col justify-center items-center w-full">
    <div class="absolute top-14 h-14 bg-purple-600 text-white w-full py-3 px-6">
        <h1 class="text-xl font-bold">Gestión de Consejos</h1>
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
                Consejo</button>
        </div>
        @if ($isOpen)
            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen">
                    <div class="fixed inset-0 bg-gray-800 opacity-75"></div>
                    <div class="bg-white mt-14 rounded-lg shadow-lg overflow-hidden max-w-lg w-full z-20">
                        <div class="p-3">
                            <h2 class="text-2xl font-bold mb-4">{{ $consejo_id ? 'Editar Consejo' : 'Crear Consejo' }}
                            </h2>
                            <form>
                                <div class="mb-4">
                                    <label for="titulo" class="block text-gray-700">Título:</label>
                                    <input type="text" id="titulo" wire:model="titulo"
                                        class="w-full px-2 py-1 border rounded-lg">
                                    @error('titulo')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="consejo" class="block text-gray-700">Consejo:</label>
                                    <textarea id="consejo" wire:model="consejo" class="w-full px-2 py-1 border rounded-lg"></textarea>
                                    @error('consejo')
                                        <span class="text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4 flex gap-2">
                                    <div class="w-1/2">
                                        <label for="semestre" class="block text-gray-700">Semestre:</label>
                                        <select id="semestre" wire:model="semestre"
                                            class="w-full px-2 py-1 border rounded-lg">
                                            <option value="">Selec. semestre</option>
                                            <option value="primer semestre"
                                                {{ $semestre == 'primer semestre' ? 'selected' : '' }}>Primer semestre
                                            </option>
                                            <option value="segundo semestre"
                                                {{ $semestre == 'segundo semestre' ? 'selected' : '' }}>Segundo semestre
                                            </option>
                                            <option value="tercer semestre"
                                                {{ $semestre == 'tercer semestre' ? 'selected' : '' }}>Tercer semestre
                                            </option>
                                            <option value="cuarto semestre"
                                                {{ $semestre == 'cuarto semestre' ? 'selected' : '' }}>Cuarto semestre
                                            </option>
                                            <option value="quinto semestre"
                                                {{ $semestre == 'quinto semestre' ? 'selected' : '' }}>Quinto semestre
                                            </option>
                                            <option value="sexto semestre"
                                                {{ $semestre == 'sexto semestre' ? 'selected' : '' }}>Sexto semestre
                                            </option>
                                            <option value="septimo semestre"
                                                {{ $semestre == 'septimo semestre' ? 'selected' : '' }}>Septimo
                                                semestre
                                            </option>
                                            <option value="octavo semestre"
                                                {{ $semestre == 'octavo semestre' ? 'selected' : '' }}>Octavo semestre
                                            </option>
                                            <option value="noveno semestre"
                                                {{ $semestre == 'noveno semestre' ? 'selected' : '' }}>Noveno semestre
                                            </option>
                                        </select>
                                        @error('semestre')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-1/2">
                                        <label for="id_materia" class="block text-gray-700">Materia:</label>
                                        <select id="id_materia" wire:model="id_materia"
                                            class="w-full px-2 py-1 border rounded-lg">
                                            <option value="">Selec. materia</option>
                                            @foreach ($materias as $materia)
                                                <option value="{{ $materia->id }}"
                                                    {{ $id_materia == $materia->id ? 'selected' : '' }}>
                                                    {{ $materia->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_materia')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4 flex gap-2">
                                    <div class="w-1/2">
                                        <label for="id_profesor" class="block text-gray-700">Profesor:</label>
                                        <select id="id_profesor" wire:model="id_profesor"
                                            class="w-full px-2 py-1 border rounded-lg">
                                            <option value="">Selec. profesor</option>
                                            @foreach ($profesores as $profesor)
                                                <option value="{{ $profesor->id }}"
                                                    {{ $id_profesor == $profesor->id ? 'selected' : '' }}>
                                                    {{ $profesor->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_profesor')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-1/2">
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
                                </div>
                                <div class="mb-4 flex gap-2">
                                    <div class="w-1/2">
                                        <div
                                            class="px-5 py-2 flex justify-start items-center gap-2 bg-white rounded-xl ">
                                            <div class="text-sm">Anónimo</div>
                                            <label class="relative inline-flex cursor-pointer items-center">
                                                <input id="anonimo" type="checkbox" class="peer sr-only"
                                                    wire:model="anonimo" />
                                                <label for="anonimo" class="hidden"></label>
                                                <div
                                                    class="peer h-6 w-11 rounded-full border bg-slate-200 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-green-300">
                                                </div>
                                            </label>
                                        </div>
                                        @error('anonimo')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-1/2">
                                        <div
                                            class="px-5 py-2 flex justify-start items-center gap-2 bg-white rounded-xl ">
                                            <span class="text-sm mr-2">No autorizar</span>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input id="toggleEstado" type="checkbox" class="peer sr-only"
                                                    wire:model="estado" />
                                                <div
                                                    class="peer h-6 w-11 rounded-full border bg-slate-200 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-green-300">
                                                </div>
                                            </label>
                                            <span class="text-sm ml-2">Autorizar</span>
                                        </div>
                                        @error('estado')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4 flex gap-2">
                                    <div class="w-1/2">
                                        <label for="like" class="block text-gray-700">likes:</label>
                                        <input type="number" id="like" wire:model="like"
                                            class="w-full px-2 py-1 border rounded-lg" min="0">
                                        @error('like')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="w-1/2">
                                        <label for="dislike" class="block text-gray-700">dislikes:</label>
                                        <input type="number" id="dislike" wire:model="dislike"
                                            class="w-full px-2 py-1 border rounded-lg" min="0">
                                        @error('dislike')
                                            <span class="text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="etiquetas" class="block text-gray-700">Etiquetas:</label>
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
                                                <input id="hack" type="checkbox" name="etiquetas[]"
                                                    value="#hack" wire:model="etiquetas"
                                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                            </label>
                                            <label for="chismesito"
                                                class="bg-rose-300 p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                                <div class="font-semibold text-sm">#chismesito</div>
                                                <input id="chismesito" type="checkbox" name="etiquetas[]"
                                                    value="#chismesito" wire:model="etiquetas"
                                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                            </label>
                                            <label for="util"
                                                class="bg-blue-400 p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                                <div class="font-semibold text-sm">#útil</div>
                                                <input id="util" type="checkbox" name="etiquetas[]"
                                                    value="#útil" wire:model="etiquetas"
                                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                            </label>
                                            <label for="hate"
                                                class="bg-lime-300 p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                                <div class="font-semibold text-sm">#hate</div>
                                                <input id="hate" type="checkbox" name="etiquetas[]"
                                                    value="#hate" wire:model="etiquetas"
                                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                            </label>
                                            <label for="microconsejo"
                                                class="bg-yellow-300 p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
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
                                                    class="{{ $colorClass }} p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                                    <div class="font-semibold text-sm">{{ $tagCustom }}</div>
                                                    <input id="{{ $tagCustom }}" type="checkbox"
                                                        name="etiquetas[]" value="{{ $tagCustom }}"
                                                        wire:model="etiquetas"
                                                        class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                                                </label>
                                            @endforeach
                                        </div>
                                        <div
                                            class="w-full overflow-hidden flex gap-2 items-center justify-center text-sm">

                                            <div class="w-3/5 flex justify-center items-center">
                                                <div class="pr-3">otro:</div>
                                                <div>#</div>
                                                <input placeholder="miEtiqueta" type="text" name="etiquetas[]"
                                                    wire:model="otraEtiqueta"
                                                    class="text-sm bg-transparent w-full p-0 border-0 border-b-2 focus:ring-0">
                                            </div>
                                            <button wire:click.prevent="agregarNuevaEtiqueta"
                                                class="w-2/5 bg-green-500 hover:bg-green-400 active:bg-green-600 font-bold py-1 px-3 rounded-xl inline-flex justify-center gap-1 items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                                <span>Agregar</span>
                                            </button>
                                        </div>
                                    </div>
                                    @error('etiquetas')
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
                        <p>¿Estás seguro de que deseas eliminar este consejo?</p>
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
                        <th class="px-4 py-2 text-center">Título</th>
                        <th class="px-4 py-2 text-center">Consejo</th>
                        <th class="px-4 py-2 text-center">Semestre</th>
                        <th class="px-4 py-2 text-center">Materia</th>
                        <th class="px-4 py-2 text-center">Profesor</th>
                        <th class="px-4 py-2 text-center">Usuario</th>
                        <th class="px-4 py-2 text-center">Anónimo</th>
                        <th class="px-4 py-2 text-center">Etiquetas</th>
                        <th class="px-4 py-2 text-center">Estado</th>
                        <th class="px-4 py-2 text-center">Likes</th>
                        <th class="px-4 py-2 text-center">Dislikes</th>
                        <th class="px-4 py-2 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consejos as $consejo)
                        <tr>
                            <td class="border px-4 py-2 text-center">{{ $consejo->id }}</td>
                            <td class="border px-4 py-2 text-center">{{ $consejo->titulo }}</td>
                            <td class="border px-4 py-2 text-center">
                                <div class="max-h-32 overflow-y-auto">{{ $consejo->consejo }}</div>
                            </td>
                            <td class="border px-4 py-2 text-center">{{ $consejo->semestre }}</td>
                            <td class="border px-4 py-2 text-center">
                                {{ $consejo->materia ? $consejo->materia->nombre : 'Ninguna en especifico' }}</td>
                            <td class="border px-4 py-2 text-center">
                                {{ $consejo->profesor ? $consejo->profesor->nombre : 'Sin especificar' }}</td>
                                <td class="border px-4 py-2 text-center">
                                    {{ $consejo->user->name }}</td>
                            <td class="border px-4 py-2 text-center">{{ $consejo->anonimo ? 'Sí' : 'No' }}</td>
                            <td class="border px-4 py-2 text-center">
                                <div class="flex flex-wrap justify-center gap-2 rounded-lg w-36">
                                    @foreach (json_decode($consejo->etiquetas, true) ?? [] as $etiqueta)
                                        <div class="bg-red-200 px-3 py-1 rounded-full">{{ $etiqueta }}</div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="border px-4 py-2 text-center">
                                {{ $consejo->estado ? 'aceptado' : 'sin aceptar' }}</td>
                            <td class="border px-4 py-2 text-center">{{ $consejo->like }}</td>
                            <td class="border px-4 py-2 text-center">{{ $consejo->dislike }}</td>
                            <td class="border px-4 py-2 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <button wire:click="edit({{ $consejo->id }})"
                                        class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded shadow">Editar</button>
                                    <button wire:click="confirmDelete({{ $consejo->id }})"
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
