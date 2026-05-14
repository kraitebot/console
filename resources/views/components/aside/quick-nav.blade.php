@props(['icon' => null, 'tabId'])
<div
    data-component-name="Aside/AsideQuickNav"
    @click="$store.aside.setActiveTab('{{ $tabId }}')"
    class="flex cursor-pointer flex-col items-center justify-between gap-2 overflow-hidden rounded-xl transition-colors duration-300 ease-in-out"
    :class="[
        $store.aside.activeTab === '{{ $tabId }}'
            ? 'bg-primary-500 hover:bg-primary-500/50 text-zinc-900'
            : 'bg-white text-zinc-600 hover:bg-zinc-100/25 dark:bg-zinc-950 dark:hover:bg-zinc-950/50',
        $store.aside.status ? 'p-4' : 'p-2.5'
    ]"
>
    <div>
        @if ($icon)
            <span class="inline-flex leading-none" :class="$store.aside.status ? 'text-2xl' : 'text-xl'">
                @includeIf('icons.' . $icon)
            </span>
        @endif
    </div>
    <div x-show="$store.aside.status">{{ $slot }}</div>
</div>
