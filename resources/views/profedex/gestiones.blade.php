<x-app-layout>
    @if ($section === 'avatars')
        @livewire('gestion-avatars')
    @elseif ($section === 'usuarios')
        @livewire('gestion-users')
    @elseif ($section === 'profesores')
        @livewire('gestion-profes')
    @elseif ($section === 'materias')
        @livewire('gestion-materias')
    @elseif ($section === 'consejos')
        @livewire('gestion-consejos')
    @elseif ($section === 'notificaciones')
        @livewire('gestion-notificaciones')
    @elseif ($section === 'productos')
        @livewire('gestion-productos')
    @elseif ($section === 'insultos')
        @livewire('gestion-malaspalabras')
    @elseif ($section === 'items')
        @livewire('gestion-items')
    @else
        <p>Sección no encontrada.</p>
    @endif
</x-app-layout>
