@extends('layouts.admin')

@section('title', $user->name . ' — Users — Kraite Console')

@section('header-left')
    <x-breadcrumb
        :list="[
            ['text' => 'Entities'],
            array_merge(config('menu.entities.users'), ['to' => route('users.index')]),
            ['text' => $user->name],
        ]"
        home-path="/dashboard"
    />
@endsection

@section('subheader')
    <x-subheader>
        <x-subheader.left>
            @foreach ($tabs as $tabName)
                @php
                    $isActive = $tab === $tabName;
                    $tabUrl = route('users.show', ['user' => $user, 'tab' => $tabName]);
                @endphp
                <x-button
                    :href="$tabUrl"
                    :variant="$isActive ? 'soft' : 'link'"
                    :color="$isActive ? 'primary' : 'zinc'"
                    :aria-label="ucfirst($tabName)"
                >
                    {{ ucfirst($tabName) }}
                </x-button>
            @endforeach
        </x-subheader.left>
        <x-subheader.right>
            <x-button href="{{ route('users.index') }}" variant="link" color="zinc" icon="ArrowLeft01">
                Back
            </x-button>
        </x-subheader.right>
    </x-subheader>
@endsection

@section('content')
    <x-container>
        @if (session('flash'))
            <div class="mb-4 rounded-lg border border-emerald-500/25 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-700 dark:text-emerald-300">
                {{ session('flash') }}
            </div>
        @endif

        @if ($tab === 'details')
            <form method="POST" action="{{ route('users.update', $user) }}" id="user-form">
                @csrf
                @method('PATCH')
                <x-card>
                    <x-card.header>
                        <x-card.header-child>
                            @php
                                $colors = ['primary', 'secondary', 'blue', 'emerald', 'amber', 'violet', 'sky', 'lime', 'red'];
                                $avatarColor = $colors[crc32($user->email) % count($colors)];
                            @endphp
                            <x-avatar :name="$user->name" size="w-16" :color="$avatarColor" variant="soft" />
                            <x-card.title>
                                <div>
                                    <div>{{ $user->name }}</div>
                                    <x-card.subtitle>User #{{ $user->id }}</x-card.subtitle>
                                </div>
                            </x-card.title>
                        </x-card.header-child>
                    </x-card.header>

                    <x-card.body>
                        <div class="flex flex-col gap-8">
                            <div class="grid grid-cols-12 gap-x-4">
                                <div class="col-span-12 pt-0 lg:col-span-3 lg:pt-4 xl:col-span-2">
                                    <x-form.label for="name">Name</x-form.label>
                                </div>
                                <div class="col-span-12 lg:col-span-9 xl:col-span-6">
                                    <x-form.input
                                        id="name"
                                        name="name"
                                        :value="old('name', $user->name)"
                                        placeholder="Name Surname"
                                    />
                                    @error('name')
                                        <p class="mt-2 text-xs text-red-500/70">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-x-4">
                                <div class="col-span-12 pt-0 lg:col-span-3 lg:pt-4 xl:col-span-2">
                                    <x-form.label for="email">Email</x-form.label>
                                </div>
                                <div class="col-span-12 lg:col-span-9 xl:col-span-6">
                                    <x-form.input
                                        id="email"
                                        type="email"
                                        name="email"
                                        :value="old('email', $user->email)"
                                        placeholder="name@kraite.com"
                                    />
                                    @error('email')
                                        <p class="mt-2 text-xs text-red-500/70">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-x-4">
                                <div class="col-span-12 pt-0 lg:col-span-3 lg:pt-4 xl:col-span-2">
                                    <x-form.label for="status">Status</x-form.label>
                                </div>
                                <div class="col-span-12 lg:col-span-9 xl:col-span-4">
                                    <div
                                        class="relative inline-flex w-full"
                                        x-data="{ open: false, status: '{{ old('status', $user->status ?? 'pending') }}' }"
                                        @click.outside="open = false"
                                        @keydown.escape.window="open = false"
                                    >
                                        <input type="hidden" name="status" :value="status">
                                        <button
                                            type="button"
                                            @click="open = !open"
                                            :aria-expanded="open"
                                            class="inline-flex w-full cursor-pointer items-center justify-between gap-2 rounded-lg border border-zinc-200 bg-white px-4 py-3 text-zinc-700 transition-colors duration-200 hover:border-blue-500 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-200"
                                        >
                                            <span x-text="status.charAt(0).toUpperCase() + status.slice(1)"></span>
                                            <x-icon name="ArrowDown01" color="zinc" />
                                        </button>
                                        <x-dropdown.menu placement="bottom-start" class="!min-w-48 w-full">
                                            @foreach (['pending', 'confirmed', 'active', 'suspended'] as $opt)
                                                <x-dropdown.item class="gap-2" @click="status = '{{ $opt }}'; open = false">
                                                    <span>{{ ucfirst($opt) }}</span>
                                                    <span x-show="status === '{{ $opt }}'" class="ms-auto">
                                                        <x-icon name="Tick02" color="primary" />
                                                    </span>
                                                </x-dropdown.item>
                                            @endforeach
                                        </x-dropdown.menu>
                                    </div>
                                    @error('status')
                                        <p class="mt-2 text-xs text-red-500/70">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-x-4">
                                <div class="col-span-12 pt-0 lg:col-span-3 lg:pt-4 xl:col-span-2">
                                    <x-form.label for="is_admin">Role</x-form.label>
                                </div>
                                <div class="col-span-12 lg:col-span-9 xl:col-span-6">
                                    <x-form.checkbox
                                        id="is_admin"
                                        name="is_admin"
                                        value="1"
                                        :checked="(bool) old('is_admin', $user->is_admin)"
                                        label="Administrator"
                                    />
                                    <x-form.description class="mt-2">Admins can access the console and manage users.</x-form.description>
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-x-4">
                                <div class="col-span-12 pt-0 lg:col-span-3 lg:pt-4 xl:col-span-2">
                                    <x-form.label>Created</x-form.label>
                                </div>
                                <div class="col-span-12 text-zinc-500 lg:col-span-9 xl:col-span-6 lg:pt-4">
                                    {{ $user->created_at?->format('Y-m-d H:i') ?? '—' }}
                                    @if ($user->email_verified_at)
                                        · verified {{ $user->email_verified_at->format('Y-m-d H:i') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </x-card.body>
                </x-card>

                <x-card class="sticky bottom-4 mt-4">
                    <x-card.footer>
                        <x-card.footer-child>
                            <span class="text-zinc-500 text-sm">
                                Last update: <strong class="font-bold text-zinc-900 dark:text-zinc-100">{{ $user->updated_at?->format('Y-m-d H:i') ?? '—' }}</strong>
                            </span>
                        </x-card.footer-child>
                        <x-card.footer-child>
                            <x-button href="{{ route('users.index') }}" variant="outline" color="zinc" aria-label="Cancel">
                                Cancel
                            </x-button>
                            <x-button type="submit" variant="solid" color="primary" icon="FloppyDisk" aria-label="Save">
                                Save
                            </x-button>
                        </x-card.footer-child>
                    </x-card.footer>
                </x-card>
            </form>
        @endif

        @if ($tab === 'accounts')
            <x-card>
                <x-card.header>
                    <x-card.header-child>
                        <x-card.title>
                            <x-icon name="UserAccount" color="primary" size="text-3xl" />
                            <div>
                                <div>Accounts</div>
                                <x-card.subtitle>Exchange accounts linked to this user</x-card.subtitle>
                            </div>
                        </x-card.title>
                    </x-card.header-child>
                </x-card.header>
                <x-card.body>
                    <x-empty />
                </x-card.body>
            </x-card>
        @endif

        @if ($tab === 'positions')
            <x-card>
                <x-card.header>
                    <x-card.header-child>
                        <x-card.title>
                            <x-icon name="ProductLoading" color="primary" size="text-3xl" />
                            <div>
                                <div>Positions</div>
                                <x-card.subtitle>Open and historical positions</x-card.subtitle>
                            </div>
                        </x-card.title>
                    </x-card.header-child>
                </x-card.header>
                <x-card.body>
                    <x-empty />
                </x-card.body>
            </x-card>
        @endif

        @if ($tab === 'billing')
            <x-card>
                <x-card.header>
                    <x-card.header-child>
                        <x-card.title>
                            <x-icon name="Invoice03" color="primary" size="text-3xl" />
                            <div>
                                <div>Billing</div>
                                <x-card.subtitle>Subscription, wallet, invoices</x-card.subtitle>
                            </div>
                        </x-card.title>
                    </x-card.header-child>
                </x-card.header>
                <x-card.body>
                    <x-empty />
                </x-card.body>
            </x-card>
        @endif
    </x-container>
@endsection
