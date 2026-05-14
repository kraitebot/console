@props(['name', 'size' => null, 'color' => null])
@php
    $colorClass = match ($color) {
        'primary' => 'text-primary-500',
        'zinc' => 'text-zinc-500',
        'blue' => 'text-blue-500',
        'red' => 'text-red-500',
        'amber' => 'text-amber-500',
        'emerald' => 'text-emerald-500',
        'rose' => 'text-rose-500',
        'sky' => 'text-sky-500',
        'violet' => 'text-violet-500',
        'lime' => 'text-lime-500',
        default => null,
    };
@endphp
<span {{ $attributes->class(['inline-flex shrink-0 items-center justify-center leading-none', $size, $colorClass]) }}>
    @includeIf('icons.' . $name)
</span>
