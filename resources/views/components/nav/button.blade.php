@props(['icon', 'iconColor' => null, 'title' => null])
<button
    data-component-name="Nav/NavButton"
    type="button"
    title="{{ $title }}"
    {{ $attributes->class(['cursor-pointer']) }}
>
    <x-icon
        :name="$icon"
        :color="$iconColor"
        size="text-2xl"
        :class="$iconColor ? 'transition-all duration-300 ease-in-out' : 'text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100 transition-all duration-300 ease-in-out'"
    />
</button>
