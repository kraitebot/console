<main
    data-component-name="PageTransition"
    {{ $attributes->class([
        'flex flex-1 flex-col transition-all duration-200 ease-out',
    ]) }}
    :class="$store.pageTransition.leaving ? 'translate-y-1 opacity-0' : 'translate-y-0 opacity-100'"
>
    {{ $slot }}
</main>
