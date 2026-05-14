@php
    $itemClasses = 'flex gap-6 rounded-3xl border border-zinc-500/25 bg-zinc-100 p-4 dark:bg-zinc-950';
@endphp
<div data-component-name="Empty" {{ $attributes->class(['translate-y-16 transform-3d']) }}>
    <div class="{{ $itemClasses }} translate-z-3">
        <div class="size-16 shrink-0 rounded-xl bg-zinc-500/25"></div>
        <div class="flex grow flex-col justify-center gap-4">
            <div class="h-4 w-3/4 rounded-xl bg-zinc-500/25"></div>
            <div class="h-4 w-full rounded-xl bg-zinc-500/25"></div>
        </div>
    </div>
    <div class="{{ $itemClasses }} -translate-y-12 translate-z-2 scale-90 opacity-75">
        <div class="size-16 shrink-0 rounded-xl bg-zinc-500/25"></div>
        <div class="flex grow flex-col justify-center gap-4">
            <div class="h-4 w-3/4 rounded-xl bg-zinc-500/25"></div>
            <div class="h-4 w-full rounded-xl bg-zinc-500/25"></div>
        </div>
    </div>
    <div class="{{ $itemClasses }} -translate-y-26 translate-z-1 scale-75 opacity-50">
        <div class="size-16 shrink-0 rounded-xl bg-zinc-500/25"></div>
        <div class="flex grow flex-col justify-center gap-4">
            <div class="h-4 w-3/4 rounded-xl bg-zinc-500/25"></div>
            <div class="h-4 w-full rounded-xl bg-zinc-500/25"></div>
        </div>
    </div>
</div>
