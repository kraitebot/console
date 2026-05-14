<li
    data-component-name="Nav/NavTitle"
    {{ $attributes->class(['list-none truncate overflow-hidden px-3 py-1.5 text-sm font-semibold whitespace-nowrap text-zinc-500']) }}
>
    <template x-if="$store.aside.status">
        <span>{{ $slot }}</span>
    </template>
    <template x-if="!$store.aside.status">
        <div class="my-1.5 h-2 w-full max-w-[6rem] rounded-full bg-zinc-500"></div>
    </template>
</li>
