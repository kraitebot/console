<div
    data-component-name="Aside/AsideBody"
    {{ $attributes->class(['h-full overflow-x-scroll px-4 no-scrollbar']) }}
>
    <div class="sticky top-0 h-4 bg-linear-to-b from-zinc-100 to-zinc-900/0 dark:from-zinc-900"></div>
    {{ $slot }}
    <div class="sticky bottom-0 h-4 bg-linear-to-t from-zinc-100 to-zinc-900/0 dark:from-zinc-900"></div>
</div>
