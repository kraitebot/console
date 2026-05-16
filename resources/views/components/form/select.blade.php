@props([
    'name',
    'value' => null,
    'id' => null,
    'placeholder' => null,
    'variant' => 'default',
    'dimension' => 'default',
    'rounded' => 'rounded-lg',
    'disabled' => false,
    'readonly' => false,
])
@php
    $variantClass = match ($variant) {
        'solid' => 'bg-zinc-100 dark:bg-zinc-800 border focus:bg-transparent dark:focus:bg-transparent',
        'gray' => 'bg-zinc-100 dark:bg-zinc-700 dark:text-zinc-200 border dark:placeholder-zinc-500',
        'underline' => 'border-b-2 !border-x-transparent !border-t-transparent bg-transparent pe-0 dark:text-zinc-200 dark:placeholder-zinc-500 focus:border-x-transparent focus:border-t-transparent focus:ring-0',
        default => 'bg-white dark:bg-zinc-900 dark:text-zinc-200 border placeholder-zinc-500',
    };
    $isDisabled = $disabled || $readonly;
    $stateClass = $variant === 'underline'
        ? 'border-b-primary-500/45 hover:border-b-primary-500/70 focus:border-b-primary-500 disabled:border-b-zinc-300 dark:disabled:border-b-zinc-700'
        : 'border-primary-500/35 hover:border-primary-500/60 focus:border-primary-500 focus:ring-primary-500/20 disabled:border-zinc-300 disabled:bg-zinc-100 dark:disabled:border-zinc-700 dark:disabled:bg-zinc-900';
    $dimensionClass = match ($dimension) {
        'sm' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-4 text-lg',
        default => 'px-4 py-3 text-base',
    };
    $roundedClass = $variant === 'underline' ? '' : $rounded;
@endphp
<div class="relative">
    <select
        data-component-name="select"
        name="{{ $name }}"
        @if($id) id="{{ $id }}" @endif
        @if($isDisabled) disabled @endif
        {{ $attributes->class([
            'w-full appearance-none outline-0 pe-11 text-zinc-700 dark:text-zinc-200 disabled:pointer-events-none disabled:opacity-60 transition-colors duration-300 ease-in-out',
            $variantClass,
            $stateClass,
            $dimensionClass,
            $roundedClass,
        ]) }}
    >
        @if ($placeholder)
            <option value="" {{ $value === null || $value === '' ? 'selected' : '' }} hidden>{{ $placeholder }}</option>
        @endif
        {{ $slot }}
    </select>
    <span class="pointer-events-none absolute inset-y-0 end-4 flex items-center text-zinc-500">
        <x-icon name="ArrowDown01" />
    </span>
</div>
