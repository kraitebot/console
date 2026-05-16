@props([
    'label',
    'value' => null,
    'icon' => null,
])

<div
    data-component-name="DataDisplay/Item"
    {{ $attributes->class([
        'rounded-lg border border-zinc-500/15 bg-zinc-50 p-3 transition-colors duration-300 dark:bg-zinc-900/60',
    ]) }}
>
    <div class="flex items-center gap-2 text-sm text-zinc-500">
        @if ($icon)
            <x-icon :name="$icon" color="primary" />
        @endif
        <span>{{ $label }}</span>
    </div>
    <div class="mt-1 text-base font-semibold text-zinc-950 dark:text-zinc-100">
        {{ $value === null || $value === '' ? '-' : $value }}
    </div>
</div>
