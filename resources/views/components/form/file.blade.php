@props([
    'name',
    'id' => null,
    'accept' => null,
    'dimension' => 'default',
])
@php
    $dimensionClass = match ($dimension) {
        'sm' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-4 text-lg',
        default => 'px-4 py-3 text-base',
    };
@endphp

<input
    data-component-name="FileInput"
    type="file"
    name="{{ $name }}"
    @if($id) id="{{ $id }}" @endif
    @if($accept) accept="{{ $accept }}" @endif
    {{ $attributes->class([
        'block w-full cursor-pointer rounded-lg border border-primary-500/35 bg-white text-zinc-700 outline-0 transition-colors duration-300 ease-in-out file:me-4 file:cursor-pointer file:rounded-md file:border-0 file:bg-primary-500 file:px-4 file:py-2 file:text-zinc-900 hover:border-primary-500/60 focus:border-primary-500 focus:ring-primary-500/20 dark:bg-zinc-900 dark:text-zinc-200',
        $dimensionClass,
    ]) }}
/>
