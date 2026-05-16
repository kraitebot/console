@props([
    'id' => null,
    'name',
    'checked' => false,
    'label' => null,
    'description' => null,
    'color' => 'blue',
    'dimension' => 'default',
    'variant' => 'default',
    'rounded' => 'rounded-lg',
    'inline' => false,
    'disabled' => false,
])
@php
    $id = $id ?? $name;
    $isSwitch = $variant === 'switch';

    $colorMap = [
        'primary' => 'checked:bg-primary-500 indeterminate:bg-primary-500',
        'blue' => 'checked:bg-blue-500 indeterminate:bg-blue-500',
        'emerald' => 'checked:bg-emerald-500 indeterminate:bg-emerald-500',
        'amber' => 'checked:bg-amber-500 indeterminate:bg-amber-500',
        'red' => 'checked:bg-red-500 indeterminate:bg-red-500',
        'zinc' => 'checked:bg-zinc-500 indeterminate:bg-zinc-500',
    ];
    $colorClass = $colorMap[$color] ?? $colorMap['blue'];

    $dimensionMap = [
        'sm' => ['box' => $isSwitch ? 'w-8 h-5' : 'w-5 h-5', 'label' => 'text-sm', 'me' => 'me-1'],
        'default' => ['box' => $isSwitch ? 'w-12 h-7' : 'w-7 h-7', 'label' => 'text-base', 'me' => 'me-1.5'],
        'lg' => ['box' => $isSwitch ? 'w-16 h-9' : 'w-9 h-9', 'label' => 'text-lg', 'me' => 'me-2'],
        'xl' => ['box' => $isSwitch ? 'w-[4.5rem] h-10' : 'w-10 h-10', 'label' => 'text-xl', 'me' => 'me-2.5'],
    ];
    $dim = $dimensionMap[$dimension] ?? $dimensionMap['default'];

    $checkIcon = "checked:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbDpzcGFjZT0icHJlc2VydmUiIHZpZXdCb3g9IjAgMCAyNCAyNCI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMCAwaDI0djI0SDB6Ii8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE3LjczOCA2LjM1MmExIDEgMCAxIDEgMS41MjQgMS4yOTZsLTguNSAxMGExIDEgMCAwIDEtMS40MjYuMWwtNC41LTRhMSAxIDAgMSAxIDEuMzI4LTEuNDk1bDMuNzM2IDMuMzIgNy44MzgtOS4yMnoiLz48L2c+PC9zdmc+')]";
    $switchOff = "bg-[url(\"data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbDpzcGFjZT0icHJlc2VydmUiIHZpZXdCb3g9IjAgMCA4IDgiPjxjaXJjbGUgY3g9IjQiIGN5PSI0IiByPSIzIiBvcGFjaXR5PSIuMjUiLz48L3N2Zz4=\")]";
    $switchOn = "checked:bg-[url(\"data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbDpzcGFjZT0icHJlc2VydmUiIHZpZXdCb3g9IjAgMCA4IDgiPjxjaXJjbGUgY3g9IjQiIGN5PSI0IiByPSIzIiBmaWxsPSIjZmZmIi8+PC9zdmc+\")]";

    $base = 'cursor-pointer appearance-none border disabled:!opacity-50 transition-all duration-300 ease-in-out !transition-[background-position,border-color,background-color] border-primary-500/35 hover:border-primary-500/60 disabled:border-zinc-300 dark:disabled:border-zinc-700 bg-center bg-no-repeat bg-transparent';

    $variantClass = $isSwitch
        ? 'rounded-full bg-left bg-origin-content checked:!bg-right ' . $switchOff . ' ' . $switchOn
        : $rounded . ' ' . $checkIcon;
@endphp
<div
    data-component-name="Checkbox"
    class="items-center py-1.5 {{ $inline ? 'inline-flex me-4' : 'flex' }}"
>
    <input
        type="checkbox"
        id="{{ $id }}"
        name="{{ $name }}"
        value="1"
        @if ($checked) checked @endif
        @if ($disabled) disabled @endif
        class="{{ $base }} {{ $variantClass }} {{ $colorClass }} {{ $dim['box'] }} {{ $label || $description ? $dim['me'] : '' }}"
        {{ $attributes->except(['class']) }}
    />
    @if ($label || $description)
        <div class="flex flex-col">
            @if ($label)
                <label for="{{ $id }}" class="cursor-pointer {{ $dim['label'] }} {{ $disabled ? '!pointer-events-none opacity-50' : '' }}">
                    {{ $label }}
                </label>
            @endif
            @if ($description)
                <label for="{{ $id }}" class="cursor-pointer text-sm text-zinc-500 {{ $disabled ? '!pointer-events-none opacity-50' : '' }}">
                    {{ $description }}
                </label>
            @endif
        </div>
    @endif
</div>
