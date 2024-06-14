@props(['label', 'type' => 'text'])

<label for="{{ $attributes->get('id') }}" class=" text-base font-boogaloo">{{ $label }}</label>
<input {{ $attributes->merge(['class' => 'w-full rounded-xl text-sm mb-2', 'type' => $type]) }}>
