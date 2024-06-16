<div class="bg-pink-600 w-full">
    <div class="flex">
        <div class="bg-pink-600 w-full lg:w-1/2 lg:px-20 lg:shrink-0">
            <div class="h-auto w-full lg:hidden bg-zinc-400 flex items-center justify-center">
                <img src="/img/home.png" alt="imagen" class="h-full w-full object-cover">
            </div>
            <div class="flex flex-col w-full p-3 justify-center">
                <div class="w-full overflow-hidden flex flex-col items-center justify-center gap-4">
                    <h1 class="lg:text-3xl text-center text-base text-white font-black">BIENVENIDO A LA PROFEDEX</h1>
                    <img class="h-auto lg:block hidden w-full" src="/img/home.png" alt="imagen">
                    <p class="lg:text-lg text-sm text-center">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis cursus nunc nec sapien
                        suscipit, a
                        condimentum augue congue. Pellentesque felis ex, rhoncus non risus at, iaculis faucibus mi.
                        Aliquam
                        vestibulum tortor a sollicitudin porta.
                    </p>
                </div>
            </div>
            <div class="flex flex-col w-full p-3 justify-center">
                <div class="w-full overflow-hidden flex flex-col items-center justify-center gap-4">
                    <h1 class="lg:text-2xl text-center text-cyan-400 font-bold">Explora el manual y descubre nuevos
                        consejos </h1>
                    @foreach ($consejos as $consejo)
                        @php
                            $colorClasses = ['bg-green-300', 'bg-blue-400', 'bg-orange-300', 'bg-fuchsia-400'];
                            $colorClass = $colorClasses[$loop->iteration % 4];
                            $etiquetas = json_decode($consejo->etiquetas, true);
                        @endphp
                        <div class="w-full rounded-xl overflow-hidden p-2 {{ $colorClass }} flex">
                            <div class=" w-full flex flex-col p-2 gap-1 overflow-hidden">
                                <div class="w-full flex justify-center items-center">
                                    <div class="w-4/5 flex flex-col shrink-0">
                                        <h1 class="font-bold lg:text-lg text-pink-600 text-sm">Consejo
                                            #{{ $consejo->id }}
                                        </h1>
                                        <span
                                            class="text-base flex w-full text-sky-800 break-words">{{ $consejo->semestre }}
                                            {{ $consejo->materia->nombre }}
                                            {{ $consejo->profesor->nombre }}
                                        </span>
                                        <div class="w-full text-2xl font-extrabold line-clamp-2 overflow-hidden">
                                            {{ $consejo->titulo }}
                                        </div>
                                    </div>
                                    <div
                                        class="w-1/5 h-full overflow-hidden flex lg:flex-row flex-col justify-center gap-3 shrink-0">
                                        <div class="flex flex-col justify-center items-center">
                                            <svg width="36" height="28" viewBox="0 0 36 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M27.6303 16.7585H33.2146C33.6377 16.7603 34.0486 16.6334 34.3786 16.399C34.7087 16.1646 34.938 15.837 35.028 15.4709C36.1686 10.9689 36.206 6.30269 35.1377 1.78682L35.0255 1.31051C34.9372 0.940747 34.7085 0.608959 34.3775 0.370476C34.0464 0.131992 33.6331 0.00122452 33.2064 -2.28882e-05H27.6299C27.1373 0.000484467 26.6651 0.17403 26.3168 0.482544C25.9685 0.791056 25.7725 1.20934 25.772 1.64563V15.1129C25.7725 15.5493 25.9685 15.9676 26.3169 16.2761C26.6653 16.5846 27.1376 16.7581 27.6303 16.7585ZM28.1661 2.12015H32.771L32.7941 2.21868C33.7633 6.31444 33.7593 10.544 32.7823 14.6383H28.1661V2.12015Z"
                                                    fill="black" />
                                                <path
                                                    d="M0.115076 11.8151L1.76752 15.718C1.89792 16.023 2.1298 16.2859 2.4325 16.4717C2.7352 16.6575 3.09446 16.7575 3.46275 16.7586H12.2678V18.7154L11.5517 20.12C11.1933 20.823 10.9957 21.5819 10.9704 22.3529C10.945 23.1239 11.0924 23.8917 11.404 24.6119C11.7156 25.3322 12.1853 25.9906 12.7859 26.5492C13.3864 27.1077 14.106 27.5553 14.903 27.8661C15.3388 28.0342 15.8316 28.0444 16.2758 27.8946C16.72 27.7447 17.0803 27.4467 17.2794 27.0644L23.2871 15.4159V13.7553H21.5119L15.3573 25.6892C14.4884 25.2148 13.8444 24.4764 13.5455 23.6121C13.2466 22.7477 13.3133 21.8166 13.7332 20.9926L14.5554 19.3799L14.6616 18.9437V15.6985L13.4647 14.6384H3.86722L2.39356 11.1581V10.5438L7.4794 2.62691H16.8257L23.2871 5.98409V3.526L17.9006 0.727303C17.6227 0.582933 17.3064 0.506798 16.9843 0.506737H7.13994C6.82027 0.507046 6.50638 0.582178 6.23005 0.724522C5.95373 0.866867 5.72478 1.07137 5.56641 1.31731L0.236561 9.61436C0.0815372 9.85611 -4.00543e-05 10.1293 -0.000196457 10.4074V11.252C-0.000301361 11.4443 0.0387478 11.6351 0.115076 11.8151Z"
                                                    fill="black" />
                                            </svg>
                                            <div class="text-sm">{{ $consejo->like }}</div>
                                        </div>
                                        <div class="flex flex-col justify-center items-center">
                                            <svg width="31" height="28" viewBox="0 0 31 28" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7.14906 10.9561H2.32853C1.96335 10.9544 1.60865 11.078 1.32372 11.3065C1.03879 11.5349 0.840905 11.8542 0.763146 12.211C-0.221408 16.5987 -0.253688 21.1464 0.668481 25.5476L0.765341 26.0119C0.841549 26.3722 1.03899 26.6956 1.32474 26.928C1.6105 27.1605 1.96729 27.2879 2.33564 27.2891H7.14939C7.5746 27.2886 7.98226 27.1195 8.28292 26.8188C8.58359 26.5181 8.75272 26.1105 8.75319 25.6853V12.5599C8.75272 12.1346 8.58354 11.7269 8.28281 11.4262C7.98207 11.1256 7.57433 10.9565 7.14906 10.9561ZM6.68652 25.2228H2.71145L2.6915 25.1268C1.85489 21.135 1.85836 17.0128 2.7017 13.0224H6.68652V25.2228Z"
                                                    fill="black" />
                                                <path
                                                    d="M30.9001 15.774L29.4737 11.9702C29.3611 11.6729 29.1609 11.4167 28.8996 11.2356C28.6383 11.0545 28.3282 10.957 28.0103 10.956H20.4096V9.04884L21.0277 7.67988C21.3371 6.99477 21.5077 6.25514 21.5296 5.50372C21.5514 4.7523 21.4242 4.004 21.1552 3.30204C20.8862 2.60008 20.4808 1.95838 19.9624 1.41401C19.4439 0.869645 18.8228 0.433402 18.1348 0.130487C17.7586 -0.0333295 17.3332 -0.0432787 16.9498 0.102771C16.5663 0.248821 16.2554 0.53925 16.0835 0.911824L10.8975 12.2646V13.883H12.4299L17.7427 2.25217C18.4927 2.71449 19.0486 3.4341 19.3066 4.2765C19.5647 5.1189 19.5071 6.02643 19.1446 6.82945L18.4349 8.40123L18.3432 8.82639V11.9892L19.3764 13.0224H27.6612L28.9332 16.4143V17.013L24.543 24.7289H16.4751L10.8975 21.4569V23.8526L15.5472 26.5802C15.7871 26.7209 16.0601 26.7952 16.3382 26.7952H24.8361C25.112 26.7949 25.383 26.7217 25.6215 26.583C25.86 26.4442 26.0577 26.2449 26.1944 26.0052L30.7952 17.9188C30.929 17.6832 30.9995 17.4169 30.9996 17.146V16.3228C30.9997 16.1353 30.966 15.9494 30.9001 15.774Z"
                                                    fill="black" />
                                            </svg>
                                            <div class="text-sm">{{ $consejo->dislike }}</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="w-full text-base font-semibold text-stone-500 line-clamp-4 overflow-hidden">
                                    {{ $consejo->consejo }}
                                </div>
                                <div class="w-ful flex justify-between">
                                    <span class=" italic text-base font-bold text-amber-700">
                                        {{ $etiquetas[0] ?? '' }}
                                        {{ $etiquetas[1] ?? '' }}
                                    </span>
                                    <a href="{{ route('login') }}">
                                        <img src="/img/continue.png" alt="imagen"
                                            class=" object-cover h-8 cursor-pointer">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col w-full p-3 justify-center">
                <div class="w-full overflow-hidden flex flex-col items-center justify-center gap-4">
                    <h1 class="text-lg lg:text-2xl text-center text-amber-400 font-bold">¡Encuentra a tus profesores con
                        nuevos estilos!</h1>
                    <div class=" w-52 bg-neutral-200 overflow-hidden">
                        <img src="/img/dio.png" alt="profe" class="bg-cover object-top w-full h-full">
                    </div>
                </div>
            </div>
            <div class="flex flex-col w-full p-3 justify-center">
                <div class="w-full overflow-hidden flex flex-col items-center justify-center gap-4">
                    <h1 class="text-lg lg:text-2xl text-center text-green-400 font-bold">Descubre los productos que
                        tenemos para ti </h1>
                    <div class="w-80 rounded-xl overflow-hidden">
                        <img src="img/camisa.png" alt="profe" class="bg-cover object-top w-full h-full">
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-teal-600 w-1/2 lg:flex shrink-0 hidden justify-center items-start p-10">
            <div class="w-2/3 flex flex-col gap-3 justify-center items-center sticky top-24">
                <span class="text-2xl text-center text-black font-bold">
                    Aconseja a los novatos, con un par de clicks o conoce a tus profesores!
                </span>
                <form wire:submit.prevent="login"
                    class="w-full bg-amber-500 flex flex-col items-center justify-center p-10 px-20">
                    <span class="font-semibold text-2xl">Inicia sesión</span>
                    <div class="min-h-10">
                        @if (session()->has('error'))
                            <div class="text-red-500 mt-2">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <label for="correo" class="text-xl w-full mb-2">Ingresa tu correo institucional</label>
                    <div class="relative w-full mb-4">
                        <input type="email" wire:model="email" id="correo" class="w-full pl-3 pr-10 py-2">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                            </svg>
                        </div>
                    </div>
                    <label for="contraseña" class="text-xl w-full mb-2">Ingresa tu contraseña</label>
                    <div class="relative w-full mb-4">
                        <input type="password" wire:model="password" id="contraseña" class="w-full pl-3 pr-10 py-2">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-5 w-5 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </div>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 bg-sky-500 text-white hover:bg-sky-600 active:bg-sky-700">Iniciar sesión
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="bg-amber-500 flex flex-col w-full p-3 items-center justify-center pb-16">
        <div class="w-10/12 py-5 text-xl font-bold text-white">DESCUBRE MÁS...</div>
        <div class="w-full overflow-hidden relative flex items-center justify-center select-none">
            <div class="w-1/12 flex justify-center items-center">
                <div id="prevButton"
                    class="bg-transparent hover:bg-neutral-200 hover:bg-opacity-50 cursor-pointer p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </div>
            </div>
            <div id="imageContainer" class="w-10/12 flex justify-center items-center overflow-hidden">
                <div id="imageWrapper" class="flex gap-5 transition-transform duration-300 ease-in-out">
                    @foreach ($profes as $profe)
                        <div class="relative h-auto flex-shrink-0 image-item">
                            <img class="object-cover w-full h-auto" src="{{ asset(json_decode($profe->imagen)[0]) }}"
                                alt="profe{{ $profe->id }}">
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="w-1/12 flex justify-center items-center">
                <div id="nextButton"
                    class="bg-transparent hover:bg-neutral-200 hover:bg-opacity-50 cursor-pointer p-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                        stroke="currentColor" class="w-12 h-12">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                </div>
            </div>

        </div>
    </div>
    <style>
        .image-item {
            width: calc(100% / 4 - 18px);
        }

        @media (max-width: 1024px) {
            .image-item {
                width: calc(100% / 3 - 18px);
            }
        }

        @media (max-width: 768px) {
            .image-item {
                width: calc(100% / 2 - 18px);
            }
        }

        @media (max-width: 640px) {
            .image-item {
                width: calc(100% / 2 - 18px);
            }
        }
        @media (max-width: 375px) {
            .image-item {
                width: calc(100% - 18px);
            }
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const imageWrapper = document.getElementById('imageWrapper');
            const images = document.querySelectorAll('#imageWrapper img');
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');
            let currentIndex = 0;

            // Función para actualizar la posición de las imágenes
            function updateImagePosition() {
                const imageWidth = images[0].offsetWidth + parseFloat(window.getComputedStyle(images[0])
                    .marginRight) + 20;
                imageWrapper.style.transform = `translateX(-${currentIndex * imageWidth}px)`;
            }

            // Manejador de evento para el botón de siguiente
            nextButton.addEventListener('click', function() {
                const imageWidth = images[0].offsetWidth + parseFloat(window.getComputedStyle(images[0])
                    .marginRight);
                const visibleImages = Math.floor((imageContainer.offsetWidth - imageWidth) / imageWidth) +
                    1;
                if (currentIndex < images.length - visibleImages) {
                    currentIndex++;
                    updateImagePosition();
                }
            });

            // Manejador de evento para el botón de anterior
            prevButton.addEventListener('click', function() {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateImagePosition();
                }
            });

            // Actualizar la posición de las imágenes al redimensionar la ventana
            window.addEventListener('resize', updateImagePosition);
        });
    </script>


</div>
