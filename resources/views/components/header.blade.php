<header
    data-component-name="Header"
    {{ $attributes->class([
        'sticky top-6 z-30 mx-2 mt-2 flex items-center justify-center rounded-xl bg-zinc-100/50 px-5 py-4 shadow-md/5 backdrop-blur-md dark:bg-zinc-900/75',
    ]) }}
>
    {{ $slot }}
</header>
