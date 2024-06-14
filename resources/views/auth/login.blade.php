<x-guest-layout>
    <div class="bg-pink-600 px-5 py-3 flex flex-col justify-start items-center h-screen">
        <div class="w-full flex justify-end mb-3">
            <div class="bg-stone-500 rounded-full p-1 hover:bg-stone-600 cursor-pointer active:bg-stone-500"
                onclick="window.history.back()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                    class="w-5 h-5 stroke-pink-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
        <div class="w-full md:w-4/6 flex flex-col items-center gap-3">
            <div class="w-full">
                <h1 class="text-left text-xl text-white font-boogaloo mb-2">Iniciar sesión</h1>
                <p class="text-sm text-white">Ingresa tus datos</p>
            </div>
            <div class="w-full">
                @if ($errors->any() || session()->has('error'))
                    <div class="text-red-500">
                        @if ($errors->any())
                            {{ $errors->first() }}
                        @elseif (session()->has('error'))
                            {{ session('error') }}
                        @endif
                    </div>
                @endif
            </div>

            <div class="p-5 w-full bg-amber-500 rounded-xl">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <x-my-input label="Correo:" id="email" class="block w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-my-input label="Contraseña:" id="password" class="block w-full" type="password" name="password"
                        required autocomplete="current-password" />
                    <div class="flex justify-end mt-4">
                        <button
                            class="ms-4 bg-blue-400 font-semibold border border-black hover:bg-blue-500 active:bg-blue-300 py-2 px-4 rounded-xl"
                            type="submit">Iniciar sesión</button>
                    </div>
                </form>
                <p class="text-center m-5 text-sm">¿Aún no tienes una cuenta? <a href="{{ route('register') }}"
                        class="text-blue-500 underline hover:no-underline hover:text-blue-700">Regístrate aquí</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>
