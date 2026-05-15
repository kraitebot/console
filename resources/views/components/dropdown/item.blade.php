@props([
    'icon' => null,
    'rightIcon' => null,
    'color' => null,
    'isActive' => false,
    'isDisabled' => false,
])
@php
    $colorClass = match ($color) {
        'primary' => 'text-primary-500',
        'secondary' => 'text-secondary-500',
        'zinc' => 'text-zinc-500',
        'red' => 'text-red-500',
        'amber' => 'text-amber-500',
        'lime' => 'text-lime-500',
        'emerald' => 'text-emerald-500',
        'sky' => 'text-sky-500',
        'blue' => 'text-blue-500',
        'violet' => 'text-violet-500',
        default => '',
    };
@endphp
<li
    data-component-name="Dropdown/DropdownItem"
    {{ $attributes->class([
        'flex w-full cursor-pointer items-center whitespace-nowrap rounded-sm p-2',
        'border-zinc-300/25 dark:border-zinc-800/50',
        'transition-colors duration-300 ease-in-out',
        'hover:bg-zinc-500/10' => ! $isDisabled,
        'bg-zinc-500/5' => $isActive,
        '!cursor-not-allowed !opacity-50' => $isDisabled,
        $colorClass => $colorClass !== '',
    ]) }}
>
    @if ($icon)
        <x-icon :name="$icon" class="inline-flex text-xl ltr:mr-1.5 rtl:ml-1.5" />
    @endif
    {{ $slot }}
    @if ($rightIcon)
        <x-icon :name="$rightIcon" class="inline-flex text-xl ltr:ml-1.5 rtl:mr-1.5" />
    @endif
</li>
