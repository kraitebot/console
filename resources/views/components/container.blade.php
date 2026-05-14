<div
    data-component-name="Container"
    {{ $attributes->class([
        'container mx-auto h-full w-full bg-white px-2 pt-4 pb-2 dark:bg-zinc-950',
    ]) }}
>
    {{ $slot }}
</div>
