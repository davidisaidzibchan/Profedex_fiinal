@props(['text' => 'Main'])

<button {{ $attributes->merge(['class' => 'bg-yellow-400 font-semibold hover:bg-yellow-500 active:bg-yellow-300 py-2 px-4 rounded-xl']) }}>
    {{ $text }}
</button>
