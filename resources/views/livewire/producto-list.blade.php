<div class="w-full min-h-screen flex flex-col bg-white">
    <div
        class="bg-teal-600 w-full min-h-screen select-none p-2 text-white font-semibold flex flex-col gap-1 justify-start items-center relative">
        <div class="absolute top-0 left-0 p-4 flex justify-center items-center">
            <svg xmlns="http://www.w3.org/2000/svg" onclick="window.history.back()" fill="none" viewBox="0 0 24 24"
                stroke-width="3" stroke="currentColor"
                class="w-10 h-10 hover:bg-stone-400 active:bg-stone-500 cursor-pointer rounded-full p-2 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
            <span>Volver</span>
        </div>
        <div class="mt-20 md:hidden w-full flex flex-col gap-5 items-center justify-center">

            @foreach ($productos as $indice => $producto)
                @php
                    $colores_disponibles = ['bg-sky-400', 'bg-lime-400', 'bg-purple-400', 'bg-orange-400'];
                    $numero_de_colores = count($colores_disponibles);
                @endphp
                <div
                    class="{{ $colores_disponibles[$indice % $numero_de_colores] }} w-full p-2 rounded-xl flex hover:rotate-1 cursor-pointer">
                    <div class="w-1/3 text-white flex items-center justify-center">
                        <img src="{{ asset($producto->imagen_path) }}" alt="producto"
                            class="object-cover object-center">
                    </div>
                    <div class="w-2/3 flex flex-col gap-2">
                        <div class="text-xl font-bold">{{ $producto->nombre }}</div>
                        <div class="text-xs">${{ $producto->precio }}</div>
                        <div class="text-xs font-sans font-thin">{{ $producto->descripcion }}</div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-20 md:flex gap-5 hidden flex-col w-10/12 bg-amber-500 p-10">
            <div class="text-2xl text-pink-700 font-bold">Productos</div>
            <div class="flex flex-wrap justify-center items-stretch">
                @foreach ($productos as $indice => $producto)
                    @php
                       $colorClasses = ['bg-green-300', 'bg-blue-400', 'bg-orange-300', 'bg-fuchsia-400'];
                       $colorClass = $colorClasses[$loop->iteration % 4];
                    @endphp
                    <div class="w-1/3 p-2">
                        <div
                        class="{{ $colorClass }} h-full p-2 rounded-xl flex hover:rotate-1 cursor-pointer">
                        <div class="w-1/3 text-white flex items-center justify-center">
                            <img src="{{ asset($producto->imagen_path) }}" alt="producto"
                                class="object-cover object-center">
                        </div>
                        <div class="w-2/3 flex flex-col gap-2">
                            <div class="text-xl font-bold">{{ $producto->nombre }}</div>
                            <div class="text-sm">${{ $producto->precio }}</div>
                            <div class="text-sm font-sans font-thin">{{ $producto->descripcion }}</div>
                        </div>
                    </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
