@props([
    'target' => 'selectTab',
    'title' => 'Loading',
    'message' => 'Fetching data...',
])

<div data-component-name="LazyTabContent" class="relative">
    <div
        wire:loading.flex
        wire:target="{{ $target }}"
        class="min-h-72 items-center justify-center rounded-xl border border-primary-500/15 bg-primary-500/5 p-8"
    >
        <div class="flex flex-col items-center gap-4 text-center">
            <div class="relative size-12">
                <div class="absolute inset-0 rounded-full border-2 border-primary-500/20"></div>
                <div class="absolute inset-0 animate-spin rounded-full border-2 border-transparent border-t-primary-500"></div>
            </div>
            <div>
                <div class="text-lg font-semibold text-zinc-950 dark:text-zinc-100">{{ $title }}</div>
                <div class="mt-1 text-base text-zinc-500">{{ $message }}</div>
            </div>
        </div>
    </div>

    <div wire:loading.remove wire:target="{{ $target }}">
        {{ $slot }}
    </div>
</div>
