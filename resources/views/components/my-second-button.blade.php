@props(['text' => 'Second'])

<button {{ $attributes->merge(['class' => 'bg-neutral-900 hover:bg-neutral-800 active:bg-neutral-700 text-white font-semibold py-2 px-4 rounded-xl']) }}>
    {{ $text }}
</button>
