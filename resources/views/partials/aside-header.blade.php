<x-aside.head>
    <a
        href="{{ route('dashboard') }}"
        wire:navigate
        aria-label="Kraite"
        class="flex items-center gap-2 overflow-hidden transition-all duration-300 ease-in-out"
        :class="$store.aside.status
            ? 'max-w-[12rem] opacity-100 ltr:translate-x-0 rtl:translate-x-0'
            : 'max-w-0 opacity-0 ltr:-translate-x-4 rtl:translate-x-4 pointer-events-none'"
    >
        <img src="/brand/snake-green.svg" alt="Kraite" class="h-9 w-9 shrink-0" />
        <span class="text-xl font-bold tracking-tight whitespace-nowrap">Kraite</span>
    </a>
    <button
        type="button"
        aria-label="Toggle Aside Menu"
        @click="$store.aside.toggle()"
        class="flex h-12 w-12 shrink-0 cursor-pointer items-center justify-center text-zinc-500 transition-transform duration-300 ease-in-out"
    >
        <span class="relative inline-flex h-6 w-6 items-center justify-center text-2xl leading-none">
            <span
                class="absolute inset-0 inline-flex items-center justify-center transition-opacity duration-300 ease-in-out"
                :class="$store.aside.status ? 'opacity-100' : 'opacity-0'"
            >
                @include('icons.SidebarLeft01')
            </span>
            <span
                class="absolute inset-0 inline-flex items-center justify-center transition-opacity duration-300 ease-in-out"
                :class="!$store.aside.status ? 'opacity-100' : 'opacity-0'"
            >
                @include('icons.SidebarLeft')
            </span>
        </span>
    </button>
</x-aside.head>
