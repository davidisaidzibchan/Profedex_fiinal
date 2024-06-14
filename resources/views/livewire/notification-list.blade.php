<div class="bg-teal-600 p-5 flex flex-col justify-start items-center ">
    <div class="w-full md:w-2/6 flex flex-col items-center py-2">
        <div class="w-full min-h-96 bg-amber-500 rounded-xl flex flex-col items-center gap-3 p-2">
            <div class="relative p-2 flex flex-col gap-5 w-full">
                <div class="absolute -top-2 -right-2 p-2 flex flex-col justify-center items-center ">
                    <div class="bg-black rounded-full p-1 hover:bg-gray-900 cursor-pointer active:bg-gray-800"
                        onclick="window.history.back()">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            class="w-5 h-5 stroke-amber-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
                <div class="text-lg font-bold">Tus notificaciones</div>
                <div class="flex flex-col-reverse gap-2">
                    @if ($notificaciones)
                        @foreach ($notificaciones as $notificacion)
                            @if ($notificacion->tipo == 1)
                                <div wire:click="mostrarOverlay({{ $notificacion->id }})"
                                    class="bg-fuchsia-700 hover:bg-fuchsia-600 active:bg-fuchsia-800 select-none cursor-pointer border-b-4 border-fuchsia-400  w-full rounded-xl px-2 py-1 flex justify-between items-center">
                                    <div class="flex gap-2 justify-center items-center">
                                        <svg class="w-4 h-4" version="1.1" id="_x32_"
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                            xml:space="preserve" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <style type="text/css">
                                                    .st0 {
                                                        fill: #000000;
                                                    }
                                                </style>
                                                <g>
                                                    <path class="st0"
                                                        d="M379.446,271.861c-17.535-3.583-34.668,7.734-38.258,25.268c-1.208,5.918-3.418,11.442-6.464,16.454 c-4.569,7.52-11.032,13.849-18.664,18.229c-7.654,4.388-16.359,6.874-25.916,6.882c-6.314,0-12.232-1.097-17.748-3.086 c-8.263-2.991-15.609-8.065-21.37-14.591c-5.746-6.534-10.015-13.929-13.194-22.278c-4.048-10.638-3.914-29.104-0.505-40.01 c2.532-8.112,10.062-20.565,20.328-27.494c5.137-3.472,10.78-6.202,16.793-8.081c6.021-1.862,12.406-2.888,19.129-2.888 c9.644,0.008,18.616,2.084,26.752,5.816c8.129,3.725,15.397,9.131,21.3,15.776c11.158,12.532,30.367,13.652,42.906,2.502 c12.54-11.151,13.668-30.359,2.509-42.907c-11.434-12.855-25.49-23.335-41.367-30.619c-15.87-7.292-33.602-11.356-52.1-11.348 c-7.402,0-14.686,0.671-21.78,1.918c8.184-15.064,17.654-30.469,28.228-45.59c15.08-21.575,32.331-42.582,50.884-61.278 c11.822-11.908,11.75-31.163-0.174-42.985C338.82-0.271,319.581-0.192,307.76,11.732v-0.008 c-28.37,28.615-53.307,60.985-73.675,93.673c-6.471,10.393-12.477,20.817-17.969,31.186c1.712-9.138,3.724-17.96,6.021-26.42 c7.182-26.389,16.864-49.424,26.839-68.814c7.165-13.929,1.689-31.03-12.24-38.195c-13.936-7.174-31.037-1.696-38.202,12.232 c-11.514,22.365-22.767,49.101-31.14,79.878c-4.206,15.467-7.686,31.968-10.109,49.416V65.718c0-13.984-11.34-25.316-25.332-25.316 c-13.983,0-25.324,11.332-25.324,25.316v169.171V512h158.225c0,0,0-31.061,0-40.515c0-20.257,10.804-35.134,25.664-43.23 c13.328-7.276,47.302-25.419,77.724-54.626c0.212-0.189,0.402-0.386,0.608-0.576c0.126-0.118,0.26-0.237,0.378-0.363 c3.284-3.014,6.416-6.195,9.336-9.556c12.84-14.82,22.049-32.971,26.145-53.008C408.298,292.584,396.989,275.459,379.446,271.861z">
                                                    </path>
                                                </g>
                                            </g>
                                        </svg>
                                        <span class="text-sm text-white">Tu consejo ha sido aprobado</span>
                                    </div>
                                    <div class="flex justify-center items-center gap-1">
                                        <div>
                                            @if ($notificacion->estado == 0)
                                                <div class="h-4 w-4 bg-emerald-500 rounded-full animate-pulse"></div>
                                            @endif
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </div>
                                </div>
                            @elseif ($notificacion->tipo == 2)
                                <div wire:click="mostrarOverlay({{ $notificacion->id }})"
                                    class="bg-pink-600 hover:bg-pink-500 active:bg-pink-700 select-none cursor-pointer border-b-4 border-rose-300  w-full rounded-xl px-2 py-1 flex justify-between items-center">
                                    <div class="flex gap-2 justify-center items-center">
                                        <svg class="w-4 h-4" viewBox="0 0 15 15" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M7.5 4C6.11929 4 5 5.11929 5 6.5C5 7.00954 5.15244 7.48349 5.4142 7.8787L8.8787 4.4142C8.48349 4.15244 8.00954 4 7.5 4Z"
                                                    fill="#000000"></path>
                                                <path
                                                    d="M7.5 9C6.99046 9 6.51653 8.84756 6.12131 8.58581L9.58581 5.12131C9.84756 5.51653 10 5.99046 10 6.5C10 7.88071 8.88071 9 7.5 9Z"
                                                    fill="#000000"></path>
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M0 1.49935C0 0.670259 0.671165 0 1.5 0H13.5C14.3288 0 15 0.670259 15 1.49935V10.4935C15 11.3226 14.3288 11.9928 13.5 11.9928H9.7675L7.91594 14.7683C7.8232 14.9074 7.66712 14.9909 7.5 14.9909C7.33288 14.9909 7.1768 14.9074 7.08406 14.7683L5.2325 11.9928H1.5C0.671165 11.9928 0 11.3226 0 10.4935V1.49935ZM4 6.5C4 4.567 5.567 3 7.5 3C9.433 3 11 4.567 11 6.5C11 8.433 9.433 10 7.5 10C5.567 10 4 8.433 4 6.5Z"
                                                    fill="#000000"></path>
                                            </g>
                                        </svg>
                                        <span class="text-sm text-white">Tu consejo no fue aprobado</span>
                                    </div>
                                    <div class="flex justify-center items-center gap-1">
                                        <div>
                                            @if ($notificacion->estado == 0)
                                                <div class="h-4 w-4 bg-emerald-500 rounded-full animate-pulse"></div>
                                            @endif
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </div>
                                </div>
                            @elseif ($notificacion->tipo == 3)
                                <div wire:click="mostrarOverlay({{ $notificacion->id }})"
                                    class="bg-sky-500 hover:bg-sky-400 active:bg-sky-600 select-none cursor-pointer border-b-4 border-blue-400  w-full rounded-xl px-2 py-1 flex justify-between items-center">
                                    <div class="flex gap-2 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path
                                                d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                                        </svg>

                                        <span class="text-sm text-white">Tu consejo ha recibido un like</span>
                                    </div>
                                    <div class="flex justify-center items-center gap-1">
                                        <div>
                                            @if ($notificacion->estado == 0)
                                                <div class="h-4 w-4 bg-emerald-500 rounded-full animate-pulse"></div>
                                            @endif
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </div>
                                </div>
                            @else
                                <div wire:click="mostrarOverlay({{ $notificacion->id }})"
                                    class="bg-neutral-500 hover:bg-neutral-400 active:bg-neutral-600 select-none cursor-pointer border-b-4 border-neutral-400  w-full rounded-xl px-2 py-1 flex justify-between items-center">
                                    <div class="flex gap-2 justify-center items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                            class="w-4 h-4">
                                            <path
                                                d="M12 .75a8.25 8.25 0 0 0-4.135 15.39c.686.398 1.115 1.008 1.134 1.623a.75.75 0 0 0 .577.706c.352.083.71.148 1.074.195.323.041.6-.218.6-.544v-4.661a6.714 6.714 0 0 1-.937-.171.75.75 0 1 1 .374-1.453 5.261 5.261 0 0 0 2.626 0 .75.75 0 1 1 .374 1.452 6.712 6.712 0 0 1-.937.172v4.66c0 .327.277.586.6.545.364-.047.722-.112 1.074-.195a.75.75 0 0 0 .577-.706c.02-.615.448-1.225 1.134-1.623A8.25 8.25 0 0 0 12 .75Z" />
                                            <path fill-rule="evenodd"
                                                d="M9.013 19.9a.75.75 0 0 1 .877-.597 11.319 11.319 0 0 0 4.22 0 .75.75 0 1 1 .28 1.473 12.819 12.819 0 0 1-4.78 0 .75.75 0 0 1-.597-.876ZM9.754 22.344a.75.75 0 0 1 .824-.668 13.682 13.682 0 0 0 2.844 0 .75.75 0 1 1 .156 1.492 15.156 15.156 0 0 1-3.156 0 .75.75 0 0 1-.668-.824Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-sm text-white">Notificacion personalizada</span>
                                    </div>
                                    <div class="flex justify-center items-center gap-1">
                                        <div>
                                            @if ($notificacion->estado == 0)
                                                <div class="h-4 w-4 bg-emerald-500 rounded-full animate-pulse"></div>
                                            @endif
                                        </div>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                                        </svg>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @else
                    <div class="text-base font-semibold w-full text-center p-10">No tienes notificaciones aún</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if ($openOverlay)
        <div id="overlay"
            class="overlay fixed top-0 left-0 w-full h-full bg-black/50 p-5 z-50 flex justify-center items-center">
            <div class="bg-pink-600 w-full md:w-2/6 min-h-44 p-5 rounded-xl flex flex-col justify-center gap-5  relative"
                onclick="event.stopPropagation();">
                <div class="hidden" id="tipo-overlay"></div>
                <div class="w-full flex justify-center items-center">
                    @if ($openOverlay->tipo == 1)
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-16 h-16">
                            <path fill-rule="evenodd"
                                d="M8.603 3.799A4.49 4.49 0 0 1 12 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 0 1 3.498 1.307 4.491 4.491 0 0 1 1.307 3.497A4.49 4.49 0 0 1 21.75 12a4.49 4.49 0 0 1-1.549 3.397 4.491 4.491 0 0 1-1.307 3.497 4.491 4.491 0 0 1-3.497 1.307A4.49 4.49 0 0 1 12 21.75a4.49 4.49 0 0 1-3.397-1.549 4.49 4.49 0 0 1-3.498-1.306 4.491 4.491 0 0 1-1.307-3.498A4.49 4.49 0 0 1 2.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 0 1 1.307-3.497 4.49 4.49 0 0 1 3.497-1.307Zm7.007 6.387a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                clip-rule="evenodd" />
                        </svg>
                    @elseif ($openOverlay->tipo == 2)
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-16 h-16">
                            <path fill-rule="evenodd"
                                d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    @elseif ($openOverlay->tipo == 3)
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-16 h-16">
                            <path
                                d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-16 h-16">
                            <path fill-rule="evenodd"
                                d="M4.848 2.771A49.144 49.144 0 0 1 12 2.25c2.43 0 4.817.178 7.152.52 1.978.292 3.348 2.024 3.348 3.97v6.02c0 1.946-1.37 3.678-3.348 3.97a48.901 48.901 0 0 1-3.476.383.39.39 0 0 0-.297.17l-2.755 4.133a.75.75 0 0 1-1.248 0l-2.755-4.133a.39.39 0 0 0-.297-.17 48.9 48.9 0 0 1-3.476-.384c-1.978-.29-3.348-2.024-3.348-3.97V6.741c0-1.946 1.37-3.68 3.348-3.97ZM6.75 8.25a.75.75 0 0 1 .75-.75h9a.75.75 0 0 1 0 1.5h-9a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H7.5Z"
                                clip-rule="evenodd" />
                        </svg>
                    @endif

                </div>
                <div class="w-full text-center" id="mensaje-overlay">{{ $openOverlay->mensaje }}</div>
                <div class="flex justify-end w-full">
                    <button wire:click="ocultarOverlay()"
                        class="bg-sky-400 font-semibold border border-black hover:bg-blue-500 active:bg-blue-300 py-2 px-4 rounded-xl"
                        type="button">OK</button>
                </div>
            </div>
            <div class="absolute top-0 left-0 p-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" wire:click="ocultarOverlay()"
                    class="w-10 h-10 hover:bg-stone-400 active:bg-stone-500 cursor-pointer rounded-full p-2 text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
        </div>
    @endif
</div>
