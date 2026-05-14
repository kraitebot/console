@props([
    'variant' => 'default',
    'color' => 'primary',
    'rounded' => 'rounded-lg',
])
@php
    $map = [
        'solid' => [
            'primary' => 'bg-primary-500 border-transparent text-zinc-800',
            'zinc' => 'bg-zinc-500 border-transparent text-zinc-800 dark:text-zinc-200',
            'emerald' => 'bg-emerald-500 border-transparent text-zinc-800 dark:text-zinc-200',
            'blue' => 'bg-blue-500 border-transparent text-zinc-800 dark:text-zinc-200',
            'amber' => 'bg-amber-500 border-transparent text-zinc-800 dark:text-zinc-200',
            'red' => 'bg-red-500 border-transparent text-zinc-800 dark:text-zinc-200',
        ],
        'outline' => [
            'primary' => 'border-primary-500 bg-primary-500/10 text-primary-500',
            'zinc' => 'border-zinc-500 bg-zinc-500/10 text-zinc-500',
            'emerald' => 'border-emerald-500 bg-emerald-500/10 text-emerald-500',
            'blue' => 'border-blue-500 bg-blue-500/10 text-blue-500',
            'amber' => 'border-amber-500 bg-amber-500/10 text-amber-500',
            'red' => 'border-red-500 bg-red-500/10 text-red-500',
        ],
        'default' => [
            'primary' => 'text-primary-500 border-transparent',
            'zinc' => 'text-zinc-500 border-transparent',
            'emerald' => 'text-emerald-500 border-transparent',
            'blue' => 'text-blue-500 border-transparent',
            'amber' => 'text-amber-500 border-transparent',
            'red' => 'text-red-500 border-transparent',
        ],
        'soft' => [
            'primary' => 'text-primary-500 bg-primary-500/10 border-transparent',
            'zinc' => 'text-zinc-500 bg-zinc-500/10 border-transparent',
            'emerald' => 'text-emerald-500 bg-emerald-500/10 border-transparent',
            'blue' => 'text-blue-500 bg-blue-500/10 border-transparent',
            'amber' => 'text-amber-500 bg-amber-500/10 border-transparent',
            'red' => 'text-red-500 bg-red-500/10 border-transparent',
        ],
    ];
    $vc = $map[$variant][$color] ?? $map['default']['primary'];
@endphp
<span {{ $attributes->class(['inline-flex items-center gap-x-1.5 px-2 border', $rounded, $vc]) }}>
    {{ $slot }}
</span>
