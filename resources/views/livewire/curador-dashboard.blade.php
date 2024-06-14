<div class="flex flex-col justify-center w-full">
    <div class="bg-gradient-to-b from-purple-500 to-indigo-600 w-full top-14 z-20 p-3 "
        style="min-height: calc(100vh - 3.5rem)">
        <div class="container mx-auto mt-2 px-2">
            <h1 class="text-4xl font-bold text-center text-white mb-8">Panel de Curador</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('pendientes') }}"
                    class="block bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">
                    <div class="p-6 flex items-center gap-4">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-12 h-auto text-gray-600">
                            <path
                                d="M10.5 1.875a1.125 1.125 0 0 1 2.25 0v8.219c.517.162 1.02.382 1.5.659V3.375a1.125 1.125 0 0 1 2.25 0v10.937a4.505 4.505 0 0 0-3.25 2.373 8.963 8.963 0 0 1 4-.935A.75.75 0 0 0 18 15v-2.266a3.368 3.368 0 0 1 .988-2.37 1.125 1.125 0 0 1 1.591 1.59 1.118 1.118 0 0 0-.329.79v3.006h-.005a6 6 0 0 1-1.752 4.007l-1.736 1.736a6 6 0 0 1-4.242 1.757H10.5a7.5 7.5 0 0 1-7.5-7.5V6.375a1.125 1.125 0 0 1 2.25 0v5.519c.46-.452.965-.832 1.5-1.141V3.375a1.125 1.125 0 0 1 2.25 0v6.526c.495-.1.997-.151 1.5-.151V1.875Z" />
                        </svg>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">Consejos Pendientes</h2>
                            <p class="text-gray-600">Revisa los consejos que están pendientes de aprobación.</p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-sm font-medium text-gray-700">Ver detalles</span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
