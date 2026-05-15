<div
    data-component-name="Dropdown"
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
    @click.outside="open = false"
    {{ $attributes->class(['relative inline-flex']) }}
>
    {{ $slot }}
</div>
