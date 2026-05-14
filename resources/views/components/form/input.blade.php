@props([
    'name',
    'type' => 'text',
    'placeholder' => '',
    'value' => null,
    'id' => null,
])
<input
    type="{{ $type }}"
    name="{{ $name }}"
    @if($id) id="{{ $id }}" @endif
    @if($value !== null) value="{{ $value }}" @endif
    placeholder="{{ $placeholder }}"
    {{ $attributes->class(['w-full bg-transparent outline-none placeholder:text-zinc-500']) }}
/>
