<div
    data-component-name="Dropdown/DropdownToggle"
    @click="open = !open"
    :aria-expanded="open"
    {{ $attributes->class(['inline-flex cursor-pointer items-center']) }}
>
    {{ $slot }}
</div>
