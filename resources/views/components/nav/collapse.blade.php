@props([
    'icon' => null,
    'iconColor' => null,
    'text',
    'to',
])
@php
    $currentPath = '/' . trim(request()->path(), '/');
    $here = $to !== '/' && str_starts_with($currentPath, rtrim($to, '/'));
    $base = 'mb-2 p-3 flex items-center cursor-pointer overflow-hidden rounded-xl hover:opacity-100 border grow transition-all duration-300 ease-in-out';
    $hereClass = 'text-zinc-950 dark:text-zinc-100 border-transparent';
    $inactiveClass = 'border-transparent text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100';
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
    data-component-name="Nav/NavCollapse"
    x-data="{ open: {{ $here ? 'true' : 'false' }} }"
    class="relative list-none group"
>
    <div
        role="presentation"
        @click="open = !open"
        class="{{ $base }}"
        :class="open ? '{{ $hereClass }}' : '{{ $inactiveClass }}'"
    >
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
            <div>
                <span
                    class="text-2xl inline-flex leading-none transition-all duration-300 ease-in-out"
                    :class="open ? 'rotate-180' : ''"
                >
                    @include('icons.ArrowDown01')
                </span>
            </div>
        </div>
    </div>
    <template x-if="$store.aside.status">
        <div class="absolute start-[0.125rem] -top-[100vh] bottom-[calc(100%-1.5rem)] hidden w-[0.8125rem] border-s border-b border-zinc-300 ltr:rounded-bl-[10px] rtl:rounded-br-[10px] dark:border-zinc-700 [.group_.group_&]:block"></div>
    </template>
    <ul
        x-show="open"
        x-collapse
        class="overflow-hidden list-none"
        :class="$store.aside.status ? 'ms-4' : ''"
    >
        {{ $slot }}
    </ul>
</li>
