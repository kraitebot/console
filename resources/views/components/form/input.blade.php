@props([
    'name',
    'type' => 'text',
    'placeholder' => '',
    'value' => null,
    'id' => null,
    'variant' => 'default',
    'dimension' => 'default',
    'rounded' => 'rounded-lg',
    'readonly' => false,
    'disabled' => false,
])
@php
    $variantMap = [
        'default' => 'bg-white dark:bg-zinc-900 dark:text-zinc-200 border placeholder-zinc-500',
        'solid' => 'bg-zinc-100 dark:bg-zinc-800 border focus:bg-transparent dark:focus:bg-transparent',
        'gray' => 'bg-zinc-100 dark:bg-zinc-700 dark:text-zinc-200 border dark:placeholder-zinc-500',
        'underline' => 'border-b-2 !border-x-transparent !border-t-transparent bg-transparent pe-0 dark:text-zinc-200 dark:placeholder-zinc-500 focus:border-x-transparent focus:border-t-transparent focus:ring-0',
    ];
    $stateClass = $variant === 'underline'
        ? 'border-b-primary-500/45 hover:border-b-primary-500/70 focus:border-b-primary-500 read-only:border-b-zinc-300 disabled:border-b-zinc-300 dark:read-only:border-b-zinc-700 dark:disabled:border-b-zinc-700'
        : 'border-primary-500/35 hover:border-primary-500/60 focus:border-primary-500 focus:ring-primary-500/20 read-only:border-zinc-300 read-only:bg-zinc-100 disabled:border-zinc-300 disabled:bg-zinc-100 dark:read-only:border-zinc-700 dark:read-only:bg-zinc-900 dark:disabled:border-zinc-700 dark:disabled:bg-zinc-900';
    $dimensionMap = [
        'sm' => 'px-4 py-2 text-sm',
        'default' => 'px-4 py-3 text-base',
        'lg' => 'px-4 py-4 text-lg',
    ];
    $variantClass = $variantMap[$variant] ?? $variantMap['default'];
    $dimensionClass = $dimensionMap[$dimension] ?? $dimensionMap['default'];
    $roundedClass = $variant === 'underline' ? '' : $rounded;
@endphp
<input
    data-component-name="Input"
    type="{{ $type }}"
    name="{{ $name }}"
    @if($id) id="{{ $id }}" @endif
    @if($value !== null) value="{{ $value }}" @endif
    @if($readonly) readonly @endif
    @if($disabled) disabled @endif
    placeholder="{{ $placeholder }}"
    {{ $attributes->class([
        'w-full peer block appearance-none outline-0 text-zinc-700 dark:text-zinc-200 disabled:pointer-events-none disabled:opacity-60 transition-colors duration-300 ease-in-out',
        $variantClass,
        $stateClass,
        $dimensionClass,
        $roundedClass,
    ]) }}
/>
