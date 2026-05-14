<div
    data-component-name="Card"
    {{ $attributes->class([
        'flex flex-col bg-white dark:bg-zinc-950 border border-zinc-500/10 dark:border-zinc-500/25 overflow-hidden rounded-xl',
    ]) }}
>
    {{ $slot }}
</div>
