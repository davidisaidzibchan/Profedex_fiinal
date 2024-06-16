<div class="flex flex-col justify-center items-center w-full">
    <div class="bg-gradient-to-b from-blue-500 to-purple-500 w-full p-3 " style="min-height: calc(100vh - 3.5rem)">
        <h1 class="text-4xl font-bold text-center text-white mb-8">Consejos Pendientes</h1>
        @if ($consejos->isEmpty())
            <div class="text-center w-full text-xl text-white">No hay consejos pendientes de aprobación</div>
        @else
            @foreach ($consejos as $consejo)
                <div class="bg-white p-6 rounded-lg shadow-md mb-8">
                    <h2 class="text-2xl font-semibold text-purple-800 mb-4">{{ $consejo->titulo }}</h2>
                    <p class="text-gray-700 mb-4">{{ $consejo->consejo }}</p>
                    <div class="flex flex-col gap-4 mb-4 bg-gray-300 rounded-lg p-3">
                        <div class="flex items-center gap-2 py-2">
                            <p class="text-gray-700 font-semibold">Semestre:</p>
                            <p class="text-indigo-600 ">{{ $consejo->semestre }}</p>
                        </div>
                        <div class="flex items-center gap-2 py-2">
                            <p class="text-gray-700 font-semibold">Materia:</p>
                            <p class="text-teal-600 ">{{ $consejo->materia ? $consejo->materia->nombre : 'No asignada' }}</p>
                        </div>
                        <div class="flex items-center gap-2 py-2">
                            <p class="text-gray-700 font-semibold">Profesor:</p>
                            <p class="text-purple-600">{{ $consejo->profesor->nombre }}</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-700 mb-4">
                        Etiquetas:
                        @foreach (json_decode($consejo->etiquetas) as $etiqueta)
                            <span class="badge bg-purple-300 text-purple-800 px-2 py-1 rounded-full">{{ $etiqueta }}</span>
                        @endforeach
                    </p>
                    <div class="mb-4 flex justify-between">
                        <div class="text-gray-700 flex flex-col items-center">
                            <p class="text-sm font-semibold">Votos para aprobar:</p>
                            <p class="text-2xl font-bold text-indigo-600">{{ \App\Models\Voto::where('id_consejo', $consejo->id)->where('decision', 'aceptar')->count() }}</p>
                        </div>
                        <div class="text-gray-700 flex flex-col items-center">
                            <p class="text-sm font-semibold">Votos para declinar:</p>
                            <p class="text-2xl font-bold text-red-600">{{ \App\Models\Voto::where('id_consejo', $consejo->id)->where('decision', 'declinar')->count() }}</p>
                        </div>
                    </div>
                    <div class="flex justify-center space-x-4">
                        <button wire:click="votarAprobar({{ $consejo->id }})" wire:loading.attr="disabled" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-opacity-50">Aceptar</button>
                        <button wire:click="votarDeclinar({{ $consejo->id }})" wire:loading.attr="disabled" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-opacity-50">Rechazar</button>
                        <a href="{{ route('consejos.edit', $consejo->id) }}" class="px-4 py-2 bg-purple-500 text-white rounded-lg hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50">Editar</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
