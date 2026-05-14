@props([
    'name',
    'type' => 'text',
    'placeholder' => '',
    'value' => null,
    'id' => null,
    'variant' => 'default',
    'dimension' => 'default',
    'rounded' => 'rounded-lg',
])
@php
    $variantMap = [
        'default' => 'bg-white dark:bg-zinc-900 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700 placeholder-zinc-500 focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-zinc-600',
        'solid' => 'bg-zinc-100 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-800 hover:border-blue-500 dark:hover:border-blue-500 focus:border-zinc-300 dark:focus:border-zinc-800 focus:bg-transparent dark:focus:bg-transparent',
        'gray' => 'bg-zinc-100 dark:bg-zinc-700 dark:text-zinc-400 border border-transparent dark:placeholder-zinc-500 focus:ring-blue-500 dark:focus:ring-zinc-600 focus:border-blue-500',
        'underline' => 'border-b-2 !border-x-transparent border-b-zinc-200 !border-t-transparent bg-transparent pe-0 dark:border-b-zinc-700 dark:text-zinc-400 dark:placeholder-zinc-500 focus:border-x-transparent focus:border-b-blue-500 focus:border-t-transparent focus:ring-0 dark:focus:border-b-zinc-600',
    ];
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
    placeholder="{{ $placeholder }}"
    {{ $attributes->class([
        'w-full peer block appearance-none outline-0 text-black dark:text-white disabled:pointer-events-none disabled:opacity-50',
        $variantClass,
        $dimensionClass,
        $roundedClass,
    ]) }}
/>
