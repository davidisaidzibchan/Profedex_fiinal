<!-- dashboard.blade.php -->
<x-app-layout>
    @if (auth()->user()->hasRole('admin'))
        @livewire('admin-dashboard')
    @elseif(auth()->user()->hasRole('curador'))
        @livewire('curador-dashboard')
    @else
        @livewire('dashboard')
    @endif
</x-app-layout>
