<div class="flex flex-col items-center justify-start gap-3 mb-5">
    <div class="w-full p-2 bg-amber-500 ">
        <div class="w-full px-5 text-sm mb-4 flex justify-center items-center gap-3">
            @if ($user->avatar_path)
                <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="avatar"
                    class="w-14 h-14 rounded-full bg-cover">
            @else
                <div class="h-14">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-full">
                        <path fill-rule="evenodd"
                            d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            @endif
            <div class="flex flex-col gap-1">
                <div class="font-semibold text-base">Bienvenido {{ $user->username }}</div>
                <div class="text-sm font-semibold">Aquí encontrarás toda la sabiduría que compartiste a los novatos.
                </div>
            </div>
        </div>
        <div class="w-full flex gap-3 px-5 justify-center items-center">
            <x-my-search-input placeholder="Buscar consejos..." wire:model="search" wire:input="$refresh" />
            <div class="w-1/2 md:w-auto flex flex-col items-center justify-start gap-3 z-10">
                <x-my-dropdown btnclass="bg-white border-2 border-black focus:bg-white">
                    <x-slot name="boton">
                        <svg id="dropdown-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.182 15.182a4.5 4.5 0 0 1-6.364 0M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0ZM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75Zm-.375 0h.008v.015h-.008V9.75Z" />
                        </svg>
                        <h1>{{ $selectedOption }}</h1>
                    </x-slot>
                    <div class="w-full" wire:click="changeSelectedOption('A-Z')">
                        <x-my-dropdown-link>
                            A-Z
                        </x-my-dropdown-link>
                    </div>
                    <div class="w-full" wire:click="changeSelectedOption('Z-A')">
                        <x-my-dropdown-link>
                            Z-A
                        </x-my-dropdown-link>
                    </div>
                    <div class="w-full" wire:click="changeSelectedOption('Más popular')">
                        <x-my-dropdown-link>
                            Más popular
                        </x-my-dropdown-link>
                    </div>
                    <div class="w-full" wire:click="changeSelectedOption('Menos popular')">
                        <x-my-dropdown-link>
                            Menos popular
                        </x-my-dropdown-link>
                    </div>
                    <div class="w-full" wire:click="changeSelectedOption('Favoritos')">
                        <x-my-dropdown-link>
                            Favoritos
                        </x-my-dropdown-link>
                    </div>
                </x-my-dropdown>
            </div>
        </div>
    </div>
    <div class="w-full flex flex-wrap justify-center items-center gap-10 mt-10">
        @if ($showNoResults)
            <div class="text-black">No hay resultados</div>
        @else
            @foreach ($consejos as $indice => $consejo)
                @php
                    $colorClasses = ['bg-green-300', 'bg-blue-400', 'bg-orange-300', 'bg-fuchsia-400'];
                    $colorClass = $colorClasses[$loop->iteration % 4];
                    $etiquetas = json_decode($consejo->etiquetas, true);
                    $reaction = DB::table('reaccion_usuarios')
                        ->where('id_consejo', $consejo->id)
                        ->where('id_usuario', auth()->id())
                        ->first();
                @endphp
                <div class="w-60 md:hidden bg-stone-400 rounded-2xl overflow-hidden z-0">
                    <div class="h-80 {{ $colorClass }} relative p-3 flex flex-col gap-2">
                        <div class="absolute top-0 right-0 p-2 flex flex-col justify-center items-center w-16">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                wire:click="toggleFavorite({{ $consejo->id }})"
                                class="w-10 h-10 stroke-none cursor-pointer {{ Auth::user()->favoritos->contains($consejo->id) ? 'fill-red-600 ' : 'fill-white ' }} active:animate-ping">
                                <path fill-rule="evenodd"
                                    d="M6.32 2.577a49.255 49.255 0 0 1 11.36 0c1.497.174 2.57 1.46 2.57 2.93V21a.75.75 0 0 1-1.085.67L12 18.089l-7.165 3.583A.75.75 0 0 1 3.75 21V5.507c0-1.47 1.073-2.756 2.57-2.93Z"
                                    clip-rule="evenodd" />
                            </svg>

                        </div>

                        <div class="w-full line-clamp-2">
                            <h1 class="font-semibold text-sm">Consejo #{{ $consejo->id }}</h1>
                            <span class=" italic text-sm">
                                @if (empty($consejo->etiquetas))
                                    #SinEtiquetas
                                @else
                                    {{ json_decode($consejo->etiquetas)[0] }}
                                @endif
                            </span>
                        </div>
                        <div class="w-full font-bold text-lg line-clamp-2">
                            {{ $consejo->titulo }}
                        </div>
                        <div class="w-full h-5 font-semibold text-sm flex justify-start items-center gap-2">
                            <div class="max-w-[100px] line-clamp-1 overflow-hidden">
                                {{ $consejo->semestre }}</div>
                            <div class=" h-5 bg-black" style="width: 1px"></div>
                            <div class="max-w-[100px] line-clamp-1 overflow-hidden">
                                @isset($consejo->profesor)
                                    {{ $consejo->profesor->nombre }}
                                @else
                                    Sin profesor asignado
                                @endisset
                            </div>

                        </div>
                        <div class="w-full text-sm h-32 line-clamp-6 overflow-hidden">
                            {{ $consejo->consejo }}
                        </div>
                        <div class="w-full flex justify-end p-1 h-10 overflow-hidden">
                            <img src="/img/continue.png" alt="imagen" class=" object-cover h-full cursor-pointer"
                                wire:click="redirectToMyRoute({{ $consejo->id }})">
                        </div>
                    </div>
                    <div
                        class="h-20 bg-stone-400 rounded-b-2xl flex justify-center items-center p-2 gap-5 font-semibold overflow-hidden">
                        <div class="w-1/2 flex justify-end items-center gap-1">
                            <div class="w-12 truncate text-right" wire:poll>
                                {{ \App\Models\Consejo::where('id', $consejo->id)->first()->like }}</div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                wire:click="like({{ $consejo->id }})"
                                class="w-10 h-10 cursor-pointer active:animate-ping {{ $reaction && $reaction->reaccion == 1 ? 'fill-white' : 'fill-black' }}">
                                <path
                                    d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                            </svg>
                        </div>
                        <div class="w-1/2 flex justify-start items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                wire:click="dislike({{ $consejo->id }})"
                                class="w-10 h-10 cursor-pointer active:animate-ping {{ $reaction && $reaction->reaccion == 0 ? 'fill-white' : 'fill-black' }}">
                                <path
                                    d="M15.73 5.5h1.035A7.465 7.465 0 0 1 18 9.625a7.465 7.465 0 0 1-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 0 1-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.499 4.499 0 0 0-.322 1.672v.633A.75.75 0 0 1 9 22a2.25 2.25 0 0 1-2.25-2.25c0-1.152.26-2.243.723-3.218.266-.558-.107-1.282-.725-1.282H3.622c-1.026 0-1.945-.694-2.054-1.715A12.137 12.137 0 0 1 1.5 12.25c0-2.848.992-5.464 2.649-7.521C4.537 4.247 5.136 4 5.754 4H9.77a4.5 4.5 0 0 1 1.423.23l3.114 1.04a4.5 4.5 0 0 0 1.423.23ZM21.669 14.023c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.958 8.958 0 0 1-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227Z" />
                            </svg>
                            <div class="w-12 truncate text-left" wire:poll>
                                {{ \App\Models\Consejo::where('id', $consejo->id)->first()->dislike }}</div>
                        </div>
                    </div>
                </div>

                <div class="w-1/3 md:flex hidden rounded-xl overflow-hidden p-2 {{ $colorClass }}">
                    <div class=" w-full flex flex-col p-2 gap-1 overflow-hidden">
                        <div class="w-full flex justify-center items-center">
                            <div class="w-4/5 flex flex-col shrink-0">
                                <h1 class="font-bold md:text-lg text-pink-600 text-sm">Consejo
                                    #{{ $consejo->id }}
                                </h1>
                                <span class="text-base flex w-full text-sky-800 break-words">{{ $consejo->semestre }}
                                    @isset($consejo->materia)
                                        {{ $consejo->materia->nombre }}
                                    @else
                                        Sin materia
                                    @endisset
                                    @isset($consejo->profesor)
                                        {{ $consejo->profesor->nombre }}
                                    @else
                                        Sin profesor asignado
                                    @endisset
                                </span>
                                <div class="w-full text-2xl font-extrabold line-clamp-2 overflow-hidden">
                                    {{ $consejo->titulo }}
                                </div>
                            </div>
                            <div
                                class="w-1/5 h-full overflow-hidden flex md:flex-row flex-col justify-center gap-3 shrink-0">
                                <div class="flex flex-col justify-center items-center">
                                    <svg width="36" height="28" viewBox="0 0 36 28" fill="none"
                                        class="cursor-pointer {{ $reaction && $reaction->reaccion == 1 ? 'fill-white' : 'fill-black' }}""
                                        wire:click="like({{ $consejo->id }})" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M27.6303 16.7585H33.2146C33.6377 16.7603 34.0486 16.6334 34.3786 16.399C34.7087 16.1646 34.938 15.837 35.028 15.4709C36.1686 10.9689 36.206 6.30269 35.1377 1.78682L35.0255 1.31051C34.9372 0.940747 34.7085 0.608959 34.3775 0.370476C34.0464 0.131992 33.6331 0.00122452 33.2064 -2.28882e-05H27.6299C27.1373 0.000484467 26.6651 0.17403 26.3168 0.482544C25.9685 0.791056 25.7725 1.20934 25.772 1.64563V15.1129C25.7725 15.5493 25.9685 15.9676 26.3169 16.2761C26.6653 16.5846 27.1376 16.7581 27.6303 16.7585ZM28.1661 2.12015H32.771L32.7941 2.21868C33.7633 6.31444 33.7593 10.544 32.7823 14.6383H28.1661V2.12015Z" />
                                        <path
                                            d="M0.115076 11.8151L1.76752 15.718C1.89792 16.023 2.1298 16.2859 2.4325 16.4717C2.7352 16.6575 3.09446 16.7575 3.46275 16.7586H12.2678V18.7154L11.5517 20.12C11.1933 20.823 10.9957 21.5819 10.9704 22.3529C10.945 23.1239 11.0924 23.8917 11.404 24.6119C11.7156 25.3322 12.1853 25.9906 12.7859 26.5492C13.3864 27.1077 14.106 27.5553 14.903 27.8661C15.3388 28.0342 15.8316 28.0444 16.2758 27.8946C16.72 27.7447 17.0803 27.4467 17.2794 27.0644L23.2871 15.4159V13.7553H21.5119L15.3573 25.6892C14.4884 25.2148 13.8444 24.4764 13.5455 23.6121C13.2466 22.7477 13.3133 21.8166 13.7332 20.9926L14.5554 19.3799L14.6616 18.9437V15.6985L13.4647 14.6384H3.86722L2.39356 11.1581V10.5438L7.4794 2.62691H16.8257L23.2871 5.98409V3.526L17.9006 0.727303C17.6227 0.582933 17.3064 0.506798 16.9843 0.506737H7.13994C6.82027 0.507046 6.50638 0.582178 6.23005 0.724522C5.95373 0.866867 5.72478 1.07137 5.56641 1.31731L0.236561 9.61436C0.0815372 9.85611 -4.00543e-05 10.1293 -0.000196457 10.4074V11.252C-0.000301361 11.4443 0.0387478 11.6351 0.115076 11.8151Z" />
                                    </svg>
                                    <div class="text-sm">
                                        {{ \App\Models\Consejo::where('id', $consejo->id)->first()->like }}</div>
                                </div>
                                <div class="flex flex-col justify-center items-center">
                                    <svg width="31" height="28" viewBox="0 0 31 28" fill="none"
                                        class="cursor-pointer {{ $reaction && $reaction->reaccion == 0 ? 'fill-white' : 'fill-black' }}""
                                        wire:click="dislike({{ $consejo->id }})" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.14906 10.9561H2.32853C1.96335 10.9544 1.60865 11.078 1.32372 11.3065C1.03879 11.5349 0.840905 11.8542 0.763146 12.211C-0.221408 16.5987 -0.253688 21.1464 0.668481 25.5476L0.765341 26.0119C0.841549 26.3722 1.03899 26.6956 1.32474 26.928C1.6105 27.1605 1.96729 27.2879 2.33564 27.2891H7.14939C7.5746 27.2886 7.98226 27.1195 8.28292 26.8188C8.58359 26.5181 8.75272 26.1105 8.75319 25.6853V12.5599C8.75272 12.1346 8.58354 11.7269 8.28281 11.4262C7.98207 11.1256 7.57433 10.9565 7.14906 10.9561ZM6.68652 25.2228H2.71145L2.6915 25.1268C1.85489 21.135 1.85836 17.0128 2.7017 13.0224H6.68652V25.2228Z" />
                                        <path
                                            d="M30.9001 15.774L29.4737 11.9702C29.3611 11.6729 29.1609 11.4167 28.8996 11.2356C28.6383 11.0545 28.3282 10.957 28.0103 10.956H20.4096V9.04884L21.0277 7.67988C21.3371 6.99477 21.5077 6.25514 21.5296 5.50372C21.5514 4.7523 21.4242 4.004 21.1552 3.30204C20.8862 2.60008 20.4808 1.95838 19.9624 1.41401C19.4439 0.869645 18.8228 0.433402 18.1348 0.130487C17.7586 -0.0333295 17.3332 -0.0432787 16.9498 0.102771C16.5663 0.248821 16.2554 0.53925 16.0835 0.911824L10.8975 12.2646V13.883H12.4299L17.7427 2.25217C18.4927 2.71449 19.0486 3.4341 19.3066 4.2765C19.5647 5.1189 19.5071 6.02643 19.1446 6.82945L18.4349 8.40123L18.3432 8.82639V11.9892L19.3764 13.0224H27.6612L28.9332 16.4143V17.013L24.543 24.7289H16.4751L10.8975 21.4569V23.8526L15.5472 26.5802C15.7871 26.7209 16.0601 26.7952 16.3382 26.7952H24.8361C25.112 26.7949 25.383 26.7217 25.6215 26.583C25.86 26.4442 26.0577 26.2449 26.1944 26.0052L30.7952 17.9188C30.929 17.6832 30.9995 17.4169 30.9996 17.146V16.3228C30.9997 16.1353 30.966 15.9494 30.9001 15.774Z" />
                                    </svg>
                                    <div class="text-sm">
                                        {{ \App\Models\Consejo::where('id', $consejo->id)->first()->dislike }}</div>
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
                            <div>
                                <img wire:click="verConsejo({{ $consejo->id }})" src="/img/continue.png"
                                    alt="imagen" class=" object-cover h-8 cursor-pointer">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

    @if ($selectedConsejo)
        <div class="fixed w-full h-full inset-0 bg-black/50 z-50 flex flex-col gap-3 justify-center items-center">
            <div class="w-2/3">
                <div class="w-full p-10 bg-orange-300 flex">
                    <div class="w-11/12 flex flex-col p-2 gap-1 overflow-hidden">
                        <div class="w-full flex justify-center items-center">
                            <div class="w-full flex flex-col shrink-0">
                                <h1 class="font-bold text-xl text-pink-600">Consejo
                                    #{{ $selectedConsejo->id }}
                                </h1>
                                <span
                                    class="text-base font-semibold flex w-full text-sky-800 break-words">{{ $consejo->semestre }}
                                    @isset($selectedConsejo->materia)
                                        {{ $selectedConsejo->materia->nombre }}
                                    @else
                                        Sin materia
                                    @endisset
                                    @isset($selectedConsejo->profesor)
                                        {{ $selectedConsejo->profesor->nombre }}
                                    @else
                                        Sin profesor asignado
                                    @endisset
                                </span>
                                <div class="w-full text-2xl font-extrabold line-clamp-2 overflow-hidden">
                                    {{ $selectedConsejo->titulo }}
                                </div>
                            </div>
                        </div>
                        <div class="w-full text-xl  text-black line-clamp-4 overflow-hidden">
                            {{ $selectedConsejo->consejo }}
                        </div>
                        <div class="w-ful flex gap-5 p-2">
                            <div class="flex gap-2 justify-center items-center">
                                <img src="{{ asset('storage/' . $selectedConsejo->user->avatar_path) }}"
                                    class="w-8 h-8 rounded-full" alt="">
                                <div class="underline text-amber-600 font-extrabold">
                                    {{ $selectedConsejo->user->username }}</div>
                            </div>
                            <div
                                class="h-full overflow-hidden flex md:flex-row flex-col justify-center gap-5 shrink-0">
                                <div class="flex gap-2 justify-center items-center">
                                    <svg width="36" height="28" viewBox="0 0 36 28" fill="none"
                                        class="fill-black" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M27.6303 16.7585H33.2146C33.6377 16.7603 34.0486 16.6334 34.3786 16.399C34.7087 16.1646 34.938 15.837 35.028 15.4709C36.1686 10.9689 36.206 6.30269 35.1377 1.78682L35.0255 1.31051C34.9372 0.940747 34.7085 0.608959 34.3775 0.370476C34.0464 0.131992 33.6331 0.00122452 33.2064 -2.28882e-05H27.6299C27.1373 0.000484467 26.6651 0.17403 26.3168 0.482544C25.9685 0.791056 25.7725 1.20934 25.772 1.64563V15.1129C25.7725 15.5493 25.9685 15.9676 26.3169 16.2761C26.6653 16.5846 27.1376 16.7581 27.6303 16.7585ZM28.1661 2.12015H32.771L32.7941 2.21868C33.7633 6.31444 33.7593 10.544 32.7823 14.6383H28.1661V2.12015Z" />
                                        <path
                                            d="M0.115076 11.8151L1.76752 15.718C1.89792 16.023 2.1298 16.2859 2.4325 16.4717C2.7352 16.6575 3.09446 16.7575 3.46275 16.7586H12.2678V18.7154L11.5517 20.12C11.1933 20.823 10.9957 21.5819 10.9704 22.3529C10.945 23.1239 11.0924 23.8917 11.404 24.6119C11.7156 25.3322 12.1853 25.9906 12.7859 26.5492C13.3864 27.1077 14.106 27.5553 14.903 27.8661C15.3388 28.0342 15.8316 28.0444 16.2758 27.8946C16.72 27.7447 17.0803 27.4467 17.2794 27.0644L23.2871 15.4159V13.7553H21.5119L15.3573 25.6892C14.4884 25.2148 13.8444 24.4764 13.5455 23.6121C13.2466 22.7477 13.3133 21.8166 13.7332 20.9926L14.5554 19.3799L14.6616 18.9437V15.6985L13.4647 14.6384H3.86722L2.39356 11.1581V10.5438L7.4794 2.62691H16.8257L23.2871 5.98409V3.526L17.9006 0.727303C17.6227 0.582933 17.3064 0.506798 16.9843 0.506737H7.13994C6.82027 0.507046 6.50638 0.582178 6.23005 0.724522C5.95373 0.866867 5.72478 1.07137 5.56641 1.31731L0.236561 9.61436C0.0815372 9.85611 -4.00543e-05 10.1293 -0.000196457 10.4074V11.252C-0.000301361 11.4443 0.0387478 11.6351 0.115076 11.8151Z" />
                                    </svg>
                                    <div class="text-sm">
                                        {{ $selectedConsejo->like }}</div>
                                </div>
                                <div class="flex gap-2 justify-center items-center">
                                    <svg width="31" height="28" viewBox="0 0 31 28" fill="none"
                                        class="fill-black" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.14906 10.9561H2.32853C1.96335 10.9544 1.60865 11.078 1.32372 11.3065C1.03879 11.5349 0.840905 11.8542 0.763146 12.211C-0.221408 16.5987 -0.253688 21.1464 0.668481 25.5476L0.765341 26.0119C0.841549 26.3722 1.03899 26.6956 1.32474 26.928C1.6105 27.1605 1.96729 27.2879 2.33564 27.2891H7.14939C7.5746 27.2886 7.98226 27.1195 8.28292 26.8188C8.58359 26.5181 8.75272 26.1105 8.75319 25.6853V12.5599C8.75272 12.1346 8.58354 11.7269 8.28281 11.4262C7.98207 11.1256 7.57433 10.9565 7.14906 10.9561ZM6.68652 25.2228H2.71145L2.6915 25.1268C1.85489 21.135 1.85836 17.0128 2.7017 13.0224H6.68652V25.2228Z" />
                                        <path
                                            d="M30.9001 15.774L29.4737 11.9702C29.3611 11.6729 29.1609 11.4167 28.8996 11.2356C28.6383 11.0545 28.3282 10.957 28.0103 10.956H20.4096V9.04884L21.0277 7.67988C21.3371 6.99477 21.5077 6.25514 21.5296 5.50372C21.5514 4.7523 21.4242 4.004 21.1552 3.30204C20.8862 2.60008 20.4808 1.95838 19.9624 1.41401C19.4439 0.869645 18.8228 0.433402 18.1348 0.130487C17.7586 -0.0333295 17.3332 -0.0432787 16.9498 0.102771C16.5663 0.248821 16.2554 0.53925 16.0835 0.911824L10.8975 12.2646V13.883H12.4299L17.7427 2.25217C18.4927 2.71449 19.0486 3.4341 19.3066 4.2765C19.5647 5.1189 19.5071 6.02643 19.1446 6.82945L18.4349 8.40123L18.3432 8.82639V11.9892L19.3764 13.0224H27.6612L28.9332 16.4143V17.013L24.543 24.7289H16.4751L10.8975 21.4569V23.8526L15.5472 26.5802C15.7871 26.7209 16.0601 26.7952 16.3382 26.7952H24.8361C25.112 26.7949 25.383 26.7217 25.6215 26.583C25.86 26.4442 26.0577 26.2449 26.1944 26.0052L30.7952 17.9188C30.929 17.6832 30.9995 17.4169 30.9996 17.146V16.3228C30.9997 16.1353 30.966 15.9494 30.9001 15.774Z" />
                                    </svg>
                                    <div class="text-sm">
                                        {{ $selectedConsejo->dislike }}</div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="w-1/12 px-5">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-12 cursor-pointer" wire:click="cerrarConsejo">
                            <path fill-rule="evenodd"
                                d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
                <div class="bg-white p-3 px-10">
                    <div class=" italic flex gap-5 text-xl font-bold text-amber-700">
                        @foreach (json_decode($selectedConsejo->etiquetas) as $etiqueta)
                            <div>{{ $etiqueta }}</div>
                        @endforeach
                    </div>
                </div>
            </div>

            @if ($selectedConsejo->id_usuario === auth()->id())
                <div class="flex gap-5 justify-center items-center">
                    <button wire:click="toggleSaved({{ $selectedConsejo->id }})" onclick="clearSavedText()"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                        {{ $selectedConsejo->guardado ? 'publicar' : 'Guardar' }}
                    </button>
                    <button wire:click="confirmDelete()"
                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                        Eliminar
                    </button>
                </div>
            @endif
        </div>
    @endif

    @if ($openModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white p-5 rounded-lg shadow-lg">
                <div class="text-xl font-bold mb-3">¿Estás seguro de eliminar este consejo?</div>
                <div class="flex justify-center items-center gap-5">
                    <button wire:click="deleteConsejo()"
                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Sí, eliminar</button>
                    <button wire:click="closeModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400">Cancelar</button>
                </div>
            </div>
        </div>
    @endif

    @if ($savedText)
        <div class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="bg-white p-5 rounded-lg shadow-lg">
                <div class="text-xl font-bold mb-3">{{ $savedText }}</div>
            </div>
        </div>
    @endif
    <script>
        function clearSavedText() {
            setTimeout(function() {
                Livewire.dispatch('clearSavedText');
            }, 2000); // Tiempo en milisegundos (en este caso, 5000 ms o 5 segundos)
        }
    </script>
</div>
