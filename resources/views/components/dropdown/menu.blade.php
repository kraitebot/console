@props([
    'placement' => 'bottom-start',
])
@php
    $placementClass = match ($placement) {
        'bottom-end' => 'top-full right-0 mt-1',
        'bottom-start' => 'top-full left-0 mt-1',
        'top-end' => 'bottom-full right-0 mb-1',
        'top-start' => 'bottom-full left-0 mb-1',
        default => 'top-full left-0 mt-1',
    };
@endphp
<ul
    data-component-name="Dropdown/DropdownMenu"
    role="presentation"
    x-show="open"
    x-cloak
    x-transition.opacity.duration.150ms
    {{ $attributes->class([
        'absolute z-[9999] flex min-w-60 flex-col gap-2 border px-2 py-2',
        'border-zinc-300/25 bg-white shadow-lg',
        'dark:border-zinc-800/50 dark:bg-zinc-900',
        'rounded-lg',
        $placementClass,
    ]) }}
>
    {{ $slot }}
</ul>
