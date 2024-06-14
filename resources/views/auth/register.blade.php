<x-guest-layout>
    <div class="bg-pink-600 px-5 py-3 flex flex-col justify-start md:justify-center items-center min-h-screen md:px-32">
        <div class="md:hidden">
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
                    <h1 class="text-left text-xl text-white font-boogaloo mb-2">Regístrate</h1>
                    <p class="text-sm text-white">Mauris eleifend varius venenatis. Nam nisl dui, consequat sed metus
                        fringilla,
                        auctor semper sapien.</p>
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
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <x-my-input label="Nombre:" id="name" class="block w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-my-input label="Usuario:" id="username" class="block w-full" type="text" name="username"
                            :value="old('username')" required autofocus />
                        <x-my-input label="Correo institucional:" id="email" class="block w-full" type="email"
                            name="email" :value="old('email')" required autocomplete="email" />
                        <x-my-input label="Contraseña:" id="password" class="block w-full" type="password"
                            name="password" required autocomplete="new-password" />
                        <x-my-input label="Confirmar contraseña:" id="password_confirmation" class="block w-full"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                        <div class="flex justify-end mt-4">
                            <button
                                class="px-4 py-2 bg-sky-500 text-white hover:bg-sky-600 active:bg-sky-700 rounded-lg"
                                type="submit">REGISTRARSE</button>
                        </div>
                    </form>


                    <p class="text-center m-5 text-sm">¿Ya estás registrado? <a href="{{ route('login') }}"
                            class="text-blue-500 underline hover:no-underline hover:text-blue-700">Inicia sesion
                            aquí</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="w-full md:flex hidden">
            <div class="w-1/2 shrink-0 flex flex-col items-center p-5">
                <div>
                    <div class="text-amber-400 text-5xl font-extrabold">Registrate</div>
                    <div class="text-sky-400 text-2xl font-extrabold">Y CONOCE TODOS LOS BENEFICIOS.</div>
                    <div class="text-white text-xl font-bold">Ingresa tus datos y conoce una nueva experiencia.
                    </div>
                   
                </div>
            </div>
            <div class="w-1/2 shrink-0">
                <div class="p-10 w-full bg-amber-500 rounded-xl">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <h1 class="w-full text-3xl text-white font-extrabold mb-4">Ingresa tus datos</h1>
                        <div class="flex flex-wrap w-full">
                            <div class="mb-4 w-1/2 shrink-0 pr-2">
                                <label for="name" class="w-full font-bold">NOMBRE</label>
                                <input id="name" class="block w-full rounded-md border border-black"
                                    placeholder="Nombre real" type="text" name="name" :value="old('name')"
                                    required autofocus autocomplete="name" />
                            </div>
                            <div class="mb-4 w-1/2 shrink-0 pl-2">
                                <label for="username" class="w-full font-bold">USUARIO</label>
                                <input id="username" class="block w-full rounded-md border border-black"
                                    placeholder="Se creativo" type="text" name="username" :value="old('username')"
                                    required autofocus />
                            </div>
                            <div class="mb-4 w-full shrink-0">
                                <label for="email" class="w-full font-bold">CORREO INSTITUCIONAL</label>
                                <input id="email" class="block w-full rounded-md border border-black"
                                    placeholder="Exclusivo para estudiantes TECNM" type="email" name="email"
                                    :value="old('email')" required autocomplete="email" />
                            </div>
                            <div class="mb-4 w-1/2 shrink-0 pr-2">
                                <label for="password" class="w-full font-bold">CONTRASEÑA</label>
                                <input id="password" class="block w-full rounded-md border border-black"
                                    placeholder="La seguridad ante todo" type="password" name="password" required
                                    autocomplete="new-password" />
                            </div>
                            <div class="mb-4 w-1/2 shrink-0 pl-2">
                                <label for="password_confirmation" class="w-full font-bold">REPETIR CONTRASEÑA</label>
                                <input id="password_confirmation" class="block w-full rounded-md border border-black"
                                    placeholder="Recuerda seguridad" type="password" name="password_confirmation"
                                    required autocomplete="new-password" />
                            </div>



                        </div>
                        <div class="flex justify-end mt-4">
                            <button
                                class="px-4 py-2 bg-sky-500 text-white hover:bg-sky-600 active:bg-sky-700 rounded-lg"
                                type="submit">REGISTRARSE</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
