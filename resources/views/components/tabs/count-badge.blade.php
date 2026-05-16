@props([
    'count' => 0,
    'active' => false,
])

<span
    data-component-name="Tabs/CountBadge"
    {{ $attributes->class([
        'ms-2 inline-flex min-w-6 items-center justify-center rounded-lg border px-1.5 py-0.5 text-xs font-semibold leading-none transition-colors duration-300',
        $active
            ? 'border-primary-500 bg-primary-500 text-zinc-950'
            : 'border-zinc-500/20 bg-zinc-500/10 text-zinc-500 dark:border-zinc-500/30',
    ]) }}
>
    {{ $count }}
</span>
