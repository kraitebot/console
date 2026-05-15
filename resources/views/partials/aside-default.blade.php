@php
    $menu = config('menu');
    $tabs = [
        'dashboard' => ['id' => 'dashboard', 'title' => 'Dashboards', 'icon' => 'Home09'],
        'apps' => ['id' => 'apps', 'title' => 'CRUDs', 'icon' => 'GridView'],
        'documentation' => ['id' => 'documentation', 'title' => 'Documentation', 'icon' => 'BookBookmark02'],
        'examples' => ['id' => 'examples', 'title' => 'Examples', 'icon' => 'Star'],
    ];
@endphp

<x-aside id="aside-permanent" data-turbo-permanent>
    @include('partials.aside-header')

    <x-aside.body>
        <div class="mb-4" x-show="$store.aside.status">
            <x-form.field-wrap
                first-icon="Search01"
                :last-suffix="'<span class=\'text-sm text-zinc-500\'>⌘K</span>'"
            >
                <x-form.input
                    name="search"
                    type="search"
                    placeholder="Search"
                    class="!border-zinc-500/25 transition-all duration-300 ease-in-out hover:!border-zinc-500/50"
                />
            </x-form.field-wrap>
        </div>
        <button
            type="button"
            x-show="!$store.aside.status"
            aria-label="Search"
            class="mb-4 flex h-[44px] w-full items-center justify-center rounded-xl border border-zinc-500/25 text-zinc-500 hover:bg-zinc-500/10"
        >
            <x-icon name="Search01" size="text-xl" />
        </button>

        <x-aside.quick-container>
            @foreach ($tabs as $tab)
                <x-aside.quick-nav :icon="$tab['icon']" :tab-id="$tab['id']">
                    {{ $tab['title'] }}
                </x-aside.quick-nav>
            @endforeach
        </x-aside.quick-container>

        <x-nav>
            {{-- DASHBOARD TAB --}}
            <template x-if="$store.aside.activeTab === 'dashboard'">
                <div>
                    <x-nav.title>Dashboards</x-nav.title>
                    <x-nav.item icon="Home09" text="Dashboard" :to="route('dashboard')" />
                    <x-nav.item :icon="$menu['apps']['sales']['icon']" :text="$menu['apps']['sales']['text']" :to="$menu['apps']['sales']['to']" />
                    <x-nav.item :icon="$menu['apps']['customer']['icon']" :text="$menu['apps']['customer']['text']" :to="$menu['apps']['customer']['to']" />
                    <x-nav.item :icon="$menu['apps']['products']['icon']" :text="$menu['apps']['products']['text']" :to="$menu['apps']['products']['to']">
                        <x-nav.button icon="PlusSignCircle" title="New" />
                    </x-nav.item>
                    <x-nav.item :icon="$menu['apps']['projects']['icon']" :text="$menu['apps']['projects']['text']" :to="$menu['apps']['projects']['to']" />
                    <x-nav.item :icon="$menu['apps']['invoices']['icon']" :text="$menu['apps']['invoices']['text']" :to="$menu['apps']['invoices']['to']" />
                    <x-nav.item :icon="$menu['apps']['mail']['icon']" :text="$menu['apps']['mail']['text']" :to="$menu['apps']['mail']['to']">
                        <x-badge variant="soft" color="emerald">8</x-badge>
                    </x-nav.item>
                    <x-nav.item :icon="$menu['apps']['chat']['icon']" :text="$menu['apps']['chat']['text']" :to="$menu['apps']['chat']['to']">
                        <x-badge variant="soft" color="zinc">Soon</x-badge>
                    </x-nav.item>
                </div>
            </template>

            {{-- CRUDS TAB --}}
            <template x-if="$store.aside.activeTab === 'apps'">
                <div>
                    <x-nav.title>Entities</x-nav.title>
                    @foreach ($menu['entities'] as $entity)
                        <x-nav.item :icon="$entity['icon']" :text="$entity['text']" :to="$entity['to']" />
                    @endforeach
                </div>
            </template>

            {{-- PAGES EXAMPLES (dashboard tab only) --}}
            <template x-if="$store.aside.activeTab === 'dashboard'">
                <div>
                    <x-nav.title>Pages Examples</x-nav.title>
                    @foreach (['list', 'grid', 'edit'] as $key)
                        @php $node = $menu['pagesExamples'][$key]; @endphp
                        <x-nav.collapse :icon="$node['icon']" :text="$node['text']" :to="$node['to']">
                            @foreach ($node['subPages'] as $sub)
                                <x-nav.item :icon="$sub['icon']" :text="$sub['text']" :to="$sub['to']" />
                            @endforeach
                        </x-nav.collapse>
                    @endforeach
                    @foreach (['login', 'signup', 'notFound', 'underConstruction'] as $key)
                        @php $node = $menu['pagesExamples'][$key]; @endphp
                        <x-nav.item :icon="$node['icon']" :text="$node['text']" :to="$node['to']" />
                    @endforeach
                </div>
            </template>
        </x-nav>
    </x-aside.body>

    @include('partials.aside-footer')
</x-aside>
