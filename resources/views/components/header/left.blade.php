<div data-component-name="Header/HeaderLeft" {{ $attributes->class(['flex items-center gap-4 ltr:mr-auto rtl:ml-auto']) }}>
    <button
        type="button"
        aria-label="Toggle Aside Menu"
        @click="$store.aside.toggle()"
        class="flex h-12 w-12 items-center justify-center md:hidden"
    >
        <span class="inline-flex text-2xl leading-none" x-show="$store.aside.status">
            @include('icons.SidebarLeft01')
        </span>
        <span class="inline-flex text-2xl leading-none" x-show="!$store.aside.status">
            @include('icons.SidebarLeft')
        </span>
    </button>
    {{ $slot }}
</div>
