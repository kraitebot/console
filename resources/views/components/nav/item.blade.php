@props([
    'icon' => null,
    'iconColor' => null,
    'text' => 'Text',
    'to' => null,
    'isActiveOverwrite' => false,
    'isChildrenNavButtonOverwrite' => false,
])
@php
    $currentPath = '/' . trim(request()->path(), '/');
    $matchTo = $to ? rtrim($to, '/') : null;
    $hereInitial = $isActiveOverwrite || ($to && $currentPath === $matchTo);
    $base = 'mb-2 p-3 flex items-center cursor-pointer overflow-hidden rounded-xl hover:opacity-100 border text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100 grow transition-all duration-300 ease-in-out focus:outline-none';
    $activeCls = 'border-zinc-300 text-zinc-950 dark:border-zinc-800 dark:text-zinc-100';
    $inactiveCls = 'border-transparent';
    $initialState = $hereInitial ? $activeCls : $inactiveCls;
    $iconColorClass = match ($iconColor) {
        'primary' => 'text-primary-500',
        'zinc' => 'text-zinc-500',
        'blue' => 'text-blue-500',
        'red' => 'text-red-500',
        'amber' => 'text-amber-500',
        'emerald' => 'text-emerald-500',
        'rose' => 'text-rose-500',
        'sky' => 'text-sky-500',
        'violet' => 'text-violet-500',
        'lime' => 'text-lime-500',
        default => '',
    };
@endphp
<li
    data-component-name="Nav/NavItem"
    class="relative flex list-none items-center whitespace-nowrap"
    :class="$store.aside.status ? '[.group_&]:ps-4' : ''"
>
    @if ($to)
        <a
            href="{{ $to }}"
            class="{{ $base }} {{ $initialState }}"
            :class="@js($isActiveOverwrite) || $store.navigation.path === @js($matchTo) ? @js($activeCls) : @js($inactiveCls)"
        >
    @else
        <button
            type="button"
            class="{{ $base }} {{ $initialState }}"
            :class="@js($isActiveOverwrite) ? @js($activeCls) : @js($inactiveCls)"
        >
    @endif
        <template x-if="$store.aside.status">
            <div class="absolute start-[0.125rem] -top-[100vh] bottom-[calc(50%+0.25rem)] hidden w-[0.8125rem] border-s border-b border-zinc-300 ltr:rounded-bl-[10px] rtl:rounded-br-[10px] dark:border-zinc-700 [.group_&]:block"></div>
        </template>
        @if ($icon)
            <span
                data-component-name="Nav/NavIcon"
                class="w-6 flex-none text-2xl inline-flex shrink-0 items-center justify-center leading-none {{ $iconColorClass }}"
                :class="$store.aside.status ? 'me-3' : ''"
            >
                @includeIf('icons.' . $icon)
            </span>
        @endif
        <div
            data-component-name="Nav/NavItemContent"
            class="flex w-full items-center justify-between truncate"
            :class="!$store.aside.status ? 'hidden' : ''"
        >
            <div data-component-name="Nav/NavItemText" class="truncate overflow-hidden whitespace-nowrap">{{ $text }}</div>
            @isset($slot)
                @if (! $isChildrenNavButtonOverwrite && ! $slot->isEmpty())
                    <div>{{ $slot }}</div>
                @endif
            @endisset
        </div>
    @if ($to)
        </a>
    @else
        </button>
    @endif
    @if ($isChildrenNavButtonOverwrite)
        <div class="mb-2 flex items-center gap-3 px-3" x-show="$store.aside.status">{{ $slot }}</div>
    @endif
</li>
