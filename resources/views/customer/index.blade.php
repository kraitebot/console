@extends('layouts.customer')

@section('title', 'Customer Dashboard — Kraite Console')

@section('header-left')
    <x-breadcrumb :list="[config('menu.apps.customer')]" home-path="/customer" />
@endsection

@section('subheader')
    <x-subheader>
        <x-subheader.left>
            <x-form.field-wrap first-icon="Search01">
                <x-form.input name="search" type="search" placeholder="Search..." />
            </x-form.field-wrap>
        </x-subheader.left>
        <x-subheader.right>
            <x-subheader.separator />
            <x-button variant="soft" color="primary" icon="UserAdd02" href="/customer/edit">
                New Customer
            </x-button>
        </x-subheader.right>
    </x-subheader>
@endsection

@section('content')
    <x-container>
        <div class="grid grid-cols-12 gap-4">
            {{-- Stat row --}}
            <div class="col-span-12">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ([
                        ['label' => 'Total Customers', 'value' => '4,328', 'delta' => '+12.4%', 'color' => 'emerald'],
                        ['label' => 'Active This Week', 'value' => '1,204', 'delta' => '+3.1%', 'color' => 'blue'],
                        ['label' => 'Pending Onboarding', 'value' => '57', 'delta' => '-2.0%', 'color' => 'amber'],
                    ] as $stat)
                        <x-card>
                            <x-card.body>
                                <div class="flex items-start justify-between">
                                    <div>
                                        <div class="text-sm text-zinc-500">{{ $stat['label'] }}</div>
                                        <div class="mt-1 text-3xl font-bold text-zinc-950 dark:text-zinc-50">{{ $stat['value'] }}</div>
                                    </div>
                                    <x-badge variant="soft" :color="$stat['color']">{{ $stat['delta'] }}</x-badge>
                                </div>
                            </x-card.body>
                        </x-card>
                    @endforeach
                </div>
            </div>

            {{-- Recent customers card --}}
            <div class="col-span-12 lg:col-span-8">
                <x-card>
                    <x-card.header>
                        <x-card.title>
                            <x-icon name="UserMultiple" color="primary" size="text-3xl" />
                            <div>
                                <div>Recent Customers</div>
                                <x-card.subtitle>Last 10 sign-ups</x-card.subtitle>
                            </div>
                        </x-card.title>
                        <x-button variant="link" color="zinc" icon="Filter">Filter</x-button>
                    </x-card.header>
                    <x-card.body>
                        <div class="divide-y divide-zinc-500/15">
                            @foreach ([
                                ['name' => 'Olivia Novak', 'email' => 'olivia@boltify.io', 'role' => 'Member'],
                                ['name' => 'Daniela Petrova', 'email' => 'daniela@boltify.io', 'role' => 'Admin'],
                                ['name' => 'Aulis Tiainen', 'email' => 'aulis@boltify.io', 'role' => 'Member'],
                                ['name' => 'Nicolas Lefevre', 'email' => 'nicolas@boltify.io', 'role' => 'Moderator'],
                            ] as $c)
                                <div class="flex items-center gap-4 py-3">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg bg-zinc-500/15 font-semibold text-zinc-700 dark:text-zinc-200">
                                        {{ mb_substr($c['name'], 0, 1) }}
                                    </span>
                                    <div class="grow">
                                        <div class="font-semibold">{{ $c['name'] }}</div>
                                        <div class="text-sm text-zinc-500">{{ $c['email'] }}</div>
                                    </div>
                                    <x-badge variant="outline" color="zinc">{{ $c['role'] }}</x-badge>
                                </div>
                            @endforeach
                        </div>
                    </x-card.body>
                </x-card>
            </div>

            {{-- Side card --}}
            <div class="col-span-12 lg:col-span-4">
                <x-card>
                    <x-card.header>
                        <x-card.title>
                            <x-icon name="UserAccount" color="blue" size="text-3xl" />
                            About
                        </x-card.title>
                    </x-card.header>
                    <x-card.body>
                        <p class="text-zinc-500">
                            This is a structural mirror of Boltify's <code class="rounded bg-zinc-500/10 px-1 text-pink-500">/customer</code>
                            dashboard. Sidebar tabs, header, breadcrumb, subheader, container and cards are all wired through the modular
                            primitives.
                        </p>
                    </x-card.body>
                    <x-card.footer>
                        <x-button variant="solid" color="primary" icon="PlusSignCircle">Action</x-button>
                        <x-button variant="outline" color="zinc">Cancel</x-button>
                    </x-card.footer>
                </x-card>
            </div>
        </div>
    </x-container>
@endsection
