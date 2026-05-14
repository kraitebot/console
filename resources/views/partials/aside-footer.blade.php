<x-aside.footer>
    <div
        data-component-name="User"
        class="relative"
    >
        <div
            class="mb-2 min-w-[4.5rem] overflow-hidden rounded-xl bg-white dark:bg-zinc-950 transition-all duration-300 ease-in-out"
            :class="!$store.aside.status && 'ltr:translate-x-[-0.625rem] rtl:translate-x-[0.625rem]'"
        >
            <div class="flex cursor-pointer gap-4 p-3 text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100 transition-all duration-300 ease-in-out">
                <div class="bg-primary-500/25 text-primary-700 dark:text-primary-400 flex aspect-square h-12 w-12 items-center justify-center rounded-lg font-semibold">
                    K
                </div>
                <div class="flex basis-full flex-wrap items-center truncate" x-show="$store.aside.status">
                    <div class="flex basis-full items-center gap-2 truncate">
                        <span class="truncate font-semibold text-zinc-950 dark:text-zinc-100">Kraite User</span>
                    </div>
                    <div class="basis-full truncate text-xs first-letter:uppercase">admin</div>
                </div>
            </div>
        </div>
        <span
            class="absolute end-0 top-0 -me-1 -mt-1 flex h-3 w-3"
            :class="!$store.aside.status && 'ltr:translate-x-[0.625rem] rtl:translate-x-[-0.625rem]'"
        >
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-blue-400 opacity-75"></span>
            <span class="relative inline-flex h-3 w-3 rounded-full bg-blue-500"></span>
        </span>
    </div>
</x-aside.footer>
