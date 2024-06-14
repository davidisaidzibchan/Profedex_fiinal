<div class="flex flex-col justify-center w-full">
    <div class="bg-pink-600 w-full sticky top-14 z-20 ">
        <nav class="mt-5 grid grid-cols-4 items-stretch justify-center px-5">
            <button wire:click.prevent="switchTab('profex')"
                class="flex flex-col justify-center items-center gap-2 rounded-t-2xl px-2 py-2 hover:bg-amber-400 tab-button @if ($activeTab === 'profex') focus:bg-amber-500 bg-amber-500 @endif">
                <h1 class="text-xs">Profedex</h1>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 @if ($activeTab != 'profex') hidden @endif"">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>
            </button>
            <button wire:click.prevent="switchTab('manual')"
                class="flex flex-col justify-center items-center gap-2 rounded-t-2xl px-2 py-2 hover:bg-amber-400 tab-button @if ($activeTab === 'manual') focus:bg-amber-500 bg-amber-500 @endif">
                <h1 class="text-xs">Manual</h1>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 @if ($activeTab != 'manual') hidden @endif">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
            </button>
            <button wire:click.prevent="switchTab('aconsejar')"
                class="flex flex-col justify-center items-center gap-2 rounded-t-2xl px-2 py-2 hover:bg-amber-400 tab-button @if ($activeTab === 'aconsejar') focus:bg-amber-500 bg-amber-500 @endif">
                <h1 class="text-xs">Aconsejar</h1>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 @if ($activeTab != 'aconsejar') hidden @endif">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                </svg>
            </button>
            <button wire:click.prevent="switchTab('mis-consejos')"
                class="flex flex-col justify-center items-center gap-2 rounded-t-2xl px-2 py-2 hover:bg-amber-400 tab-button @if ($activeTab === 'mis-consejos') focus:bg-amber-500 bg-amber-500 @endif">
                <h1 class="text-xs">Mis consejos</h1>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-6 w-6 @if ($activeTab != 'mis-consejos') hidden @endif">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 12h16.5m-16.5 3.75h16.5M3.75 19.5h16.5M5.625 4.5h12.75a1.875 1.875 0 0 1 0 3.75H5.625a1.875 1.875 0 0 1 0-3.75Z" />
                </svg>
            </button>
        </nav>
        <div class="bg-amber-500 w-full h-5"></div>
    </div> 
    <div class="tab">
        @if ($activeTab == 'profex')
            @livewire('profes-list')
        @elseif($activeTab == 'manual')
            @livewire('consejos-list')
        @elseif($activeTab == 'aconsejar')
            @livewire('consejo-post')
        @elseif($activeTab == 'mis-consejos')
            @livewire('mis-consejos')
        @endif
    </div>
</div>
