<div
    data-component-name="ToastContainer"
    x-data
    class="pointer-events-none fixed end-6 top-6 z-[120] flex w-full max-w-sm flex-col gap-3"
>
    <template x-for="toast in $store.toast.items" :key="toast.id">
        <div
            data-component-name="Toast"
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="translate-y-2 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="translate-y-2 opacity-0"
            class="pointer-events-auto flex items-start gap-3 rounded-xl border px-4 py-3 shadow-xl shadow-black/25 backdrop-blur-md"
            :class="{
                'border-primary-600 bg-primary-500 text-zinc-950': toast.type === 'success',
                'border-amber-500 bg-amber-400 text-zinc-950': toast.type === 'alert',
                'border-red-500 bg-red-500 text-white': toast.type === 'error',
            }"
        >
            <div
                class="mt-1 size-2.5 shrink-0 rounded-full"
                :class="{
                    'bg-zinc-950': toast.type === 'success' || toast.type === 'alert',
                    'bg-white': toast.type === 'error',
                }"
            ></div>
            <div class="min-w-0 flex-1">
                <div class="text-sm font-semibold" x-text="toast.title"></div>
                <div class="mt-0.5 text-sm opacity-75" x-text="toast.message"></div>
            </div>
            <button
                type="button"
                class="shrink-0 opacity-60 transition-opacity hover:opacity-100"
                aria-label="Dismiss"
                x-on:click="$store.toast.dismiss(toast.id)"
            >
                <span class="text-lg leading-none">&times;</span>
            </button>
        </div>
    </template>
</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/toast-container.blade.php ENDPATH**/ ?>