<div class="flex flex-col justify-center items-center w-full">
    <div class="bg-gradient-to-b from-blue-400 to-purple-600 w-full p-3 shadow-lg"
        style="min-height: calc(100vh - 3.5rem)">
        <h1 class="text-3xl font-bold text-center text-white mb-6">Editar Consejo Pendiente</h1>
        @if ($consejoId)
            <div class="bg-white p-4 rounded-lg shadow-md mb-6">
                <div class="mb-4">
                    <label for="titulo" class="block text-gray-700 text-xs font-bold mb-1">Título:</label>
                    <input wire:model="titulo" type="text" id="titulo" name="titulo"
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm">
                </div>
                <div class="mb-4">
                    <label for="consejo" class="block text-gray-700 text-xs font-bold mb-1">Consejo:</label>
                    <textarea wire:model="consejo" id="consejo" name="consejo" rows="6"
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm"></textarea>
                </div>
                <div class="mb-4">
                    <label for="semestre" class="block text-gray-700 text-xs font-bold mb-1">Semestre:</label>
                    <select wire:model="semestre" id="semestre" name="semestre"
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm">
                        <option value="primer semestre">Primer Semestre</option>
                        <option value="segundo semestre">Segundo Semestre</option>
                        <option value="tercer semestre">Tercer Semestre</option>
                        <option value="cuarto semestre">Cuarto Semestre</option>
                        <option value="quinto semestre">Quinto Semestre</option>
                        <option value="sexto semestre">Sexto Semestre</option>
                        <option value="septimo semestre">Septimo Semestre</option>
                        <option value="octavo semestre">Octavo Semestre</option>
                        <option value="noveno semestre">Noveno Semestre</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="materia" class="block text-gray-700 text-xs font-bold mb-1">Materia:</label>
                    <select wire:model="id_materia" id="materia" name="materia"
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm">
                        <option value="">Selecciona una materia</option>
                        @foreach ($materias as $materia)
                            <option value="{{ $materia->id }}">{{ $materia->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="profesor" class="block text-gray-700 text-xs font-bold mb-1">Profesor:</label>
                    <select wire:model="id_profesor" id="profesor" name="profesor"
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm">
                        <option value="">Selecciona un profesor</option>
                        @foreach ($profesores as $profesor)
                            <option value="{{ $profesor->id }}">{{ $profesor->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4 bg-purple-600/20 p-3  rounded-xl">
                    <label for="etiquetas" class="block text-xs font-bold mb-1">Etiquetas:</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach (['#salvasemestres', '#hack', '#chismesito', '#útil', '#hate', '#microconsejo'] as $tag)
                            <label class="bg-orange-400  text-white p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                <div class="font-semibold text-xs">{{ $tag }}</div>
                                <input type="checkbox" name="etiquetas[]" value="{{ $tag }}"
                                    wire:model="etiquetas"
                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                            </label>
                        @endforeach
                
                        @foreach ($etiquetasPersonalizadas as $index => $tagCustom)
                            <label class="bg-sky-400 text-white p-2 rounded-xl cursor-pointer flex justify-center items-center gap-2 flex-grow">
                                <div class="font-semibold text-xs">{{ $tagCustom }}</div>
                                <input type="checkbox" name="etiquetas[]" value="{{ $tagCustom }}"
                                    wire:model="etiquetas" wire:click="agregarNuevaEtiqueta"
                                    class="bg-transparent rounded-full border-2 border-black focus:outline-none focus:ring-transparent checked:bg-black focus:checked:bg-black hover:checked:bg-gray-800">
                            </label>
                        @endforeach
                    </div>
                
                    <div class="flex flex-wrap w-full gap-2 items-center mt-8">
                        <input type="text" wire:model="otraEtiqueta" placeholder="Nueva etiqueta"
                            class="appearance-none border h-full w-1/2 rounded py-1 px-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-sm">
                        <button wire:click="agregarNuevaEtiqueta"
                            class="bg-green-500 h-full hover:bg-green-400 active:bg-green-600 text-white font-bold py-1 px-4 rounded">Agregar</button>
                    </div>
                </div>
                

                <button type="button" wire:click="updateConsejo()"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded">Actualizar</button>

            </div>
        @else
            <p class="text-xs">No se encontró el consejo.</p>
        @endif
    </div>
</div>
