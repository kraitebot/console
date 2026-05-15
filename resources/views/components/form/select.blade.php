@props([
    'name',
    'value' => null,
    'id' => null,
    'placeholder' => null,
    'variant' => 'default',
    'dimension' => 'default',
    'rounded' => 'rounded-lg',
])
@php
    $variantClass = match ($variant) {
        'solid' => 'bg-zinc-100 dark:bg-zinc-800 border border-zinc-100 dark:border-zinc-800 hover:border-blue-500 dark:hover:border-blue-500 focus:border-zinc-300 dark:focus:border-zinc-800 focus:bg-transparent dark:focus:bg-transparent',
        'gray' => 'bg-zinc-100 dark:bg-zinc-700 dark:text-zinc-400 border border-transparent dark:placeholder-zinc-500 focus:ring-blue-500 dark:focus:ring-zinc-600 focus:border-blue-500',
        'underline' => 'border-b-2 !border-x-transparent border-b-zinc-200 !border-t-transparent bg-transparent pe-0 dark:border-b-zinc-700 dark:text-zinc-400 dark:placeholder-zinc-500 focus:border-x-transparent focus:border-b-blue-500 focus:border-t-transparent focus:ring-0',
        default => 'bg-white dark:bg-zinc-900 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700 placeholder-zinc-500 focus:border-blue-500 focus:ring-blue-500 dark:focus:ring-zinc-600',
    };
    $dimensionClass = match ($dimension) {
        'sm' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-4 text-lg',
        default => 'px-4 py-3 text-base',
    };
    $roundedClass = $variant === 'underline' ? '' : $rounded;
@endphp
<select
    data-component-name="select"
    name="{{ $name }}"
    @if($id) id="{{ $id }}" @endif
    {{ $attributes->class([
        'w-full appearance-none outline-0 text-zinc-700 dark:text-zinc-200 disabled:pointer-events-none disabled:opacity-50 transition-all duration-300',
        $variantClass,
        $dimensionClass,
        $roundedClass,
    ]) }}
>
    @if ($placeholder)
        <option value="" {{ $value === null || $value === '' ? 'selected' : '' }} hidden>{{ $placeholder }}</option>
    @endif
    {{ $slot }}
</select>
