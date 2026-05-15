@extends('layouts.admin')

@section('title', 'Users — Kraite Console')

@section('header-left')
    <x-breadcrumb
        :list="[['text' => 'Entities'], config('menu.entities.users')]"
        home-path="/dashboard"
    />
@endsection

@section('subheader')
    <x-subheader>
        <x-subheader.left>
            <form method="GET" action="{{ route('users.index') }}" class="w-full sm:w-80">
                <x-form.field-wrap first-icon="Search02">
                    <x-form.input
                        name="q"
                        :value="$search"
                        variant="solid"
                        dimension="sm"
                        placeholder="Search name or email..."
                    />
                </x-form.field-wrap>
            </form>
        </x-subheader.left>
        <x-subheader.right>
            <x-subheader.separator />
            <x-button
                href="{{ route('users.create') }}"
                aria-label="New User"
                variant="soft"
                color="primary"
                icon="UserAdd02"
            >
                New User
            </x-button>
        </x-subheader.right>
    </x-subheader>
@endsection

@section('content')
    <x-container>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-card>
                    <x-card.header>
                        <x-card.header-child>
                            <x-card.title>
                                <x-icon name="UserMultiple" color="primary" size="text-3xl" />
                                <div>
                                    <div>Users</div>
                                    <x-card.subtitle>{{ $users->total() }} total</x-card.subtitle>
                                </div>
                            </x-card.title>
                        </x-card.header-child>
                    </x-card.header>

                    <x-card.body class="overflow-auto">
                        @if ($users->isEmpty())
                            <x-empty />
                        @else
                            <x-table>
                                <x-table.head>
                                    <x-table.tr>
                                        <x-table.th class="w-12 text-left" :is-column-border="false"></x-table.th>
                                        @foreach ([
                                            'name' => 'Name',
                                            'email' => 'Email',
                                            'is_admin' => 'Role',
                                            'status' => 'Status',
                                            'created_at' => 'Joined',
                                        ] as $col => $label)
                                            @php
                                                $isActive = $sort === $col;
                                                $nextDir = $isActive && $direction === 'asc' ? 'desc' : 'asc';
                                                $sortUrl = route('users.index', array_filter([
                                                    'q' => $search ?: null,
                                                    'sort' => $col,
                                                    'dir' => $nextDir,
                                                ]));
                                                $sortIcon = ! $isActive
                                                    ? 'Sorting05'
                                                    : ($direction === 'asc' ? 'Sorting02' : 'Sorting01');
                                            @endphp
                                            <x-table.th class="text-left" :is-column-border="false">
                                                <a href="{{ $sortUrl }}" class="inline-flex cursor-pointer items-center gap-2 select-none">
                                                    {{ $label }}
                                                    <x-icon :name="$sortIcon" :color="$isActive ? 'blue' : 'zinc'" />
                                                </a>
                                            </x-table.th>
                                        @endforeach
                                        <x-table.th class="text-right" :is-column-border="false">Actions</x-table.th>
                                    </x-table.tr>
                                </x-table.head>

                                <x-table.body>
                                    @foreach ($users as $user)
                                        @php
                                            $colors = ['primary', 'secondary', 'blue', 'emerald', 'amber', 'violet', 'sky', 'lime', 'red'];
                                            $avatarColor = $colors[crc32($user->email) % count($colors)];
                                            $rowUrl = route('users.show', $user);
                                        @endphp
                                        <x-table.tr
                                            class="cursor-pointer"
                                            x-data
                                            @click="window.location.href = '{{ $rowUrl }}'"
                                        >
                                            <x-table.td>
                                                <x-avatar :name="$user->name" size="w-10" :color="$avatarColor" variant="soft" />
                                            </x-table.td>
                                            <x-table.td class="font-semibold text-zinc-900 dark:text-zinc-100">
                                                {{ $user->name }}
                                            </x-table.td>
                                            <x-table.td class="text-zinc-500">{{ $user->email }}</x-table.td>
                                            <x-table.td>
                                                @if ($user->is_admin)
                                                    <x-badge variant="soft" color="primary">Admin</x-badge>
                                                @else
                                                    <x-badge variant="soft" color="zinc">User</x-badge>
                                                @endif
                                            </x-table.td>
                                            <x-table.td>
                                                @php
                                                    $statusColor = match ($user->status) {
                                                        'active' => 'emerald',
                                                        'confirmed' => 'blue',
                                                        'pending' => 'amber',
                                                        default => 'zinc',
                                                    };
                                                @endphp
                                                <x-badge variant="soft" :color="$statusColor">
                                                    {{ ucfirst($user->status ?? 'unknown') }}
                                                </x-badge>
                                            </x-table.td>
                                            <x-table.td class="text-zinc-500">
                                                {{ $user->created_at?->diffForHumans() ?? '—' }}
                                            </x-table.td>
                                            <x-table.td class="text-right">
                                                <span @click.stop>
                                                    <x-button
                                                        href="{{ $rowUrl }}"
                                                        aria-label="Edit user"
                                                        icon="PencilEdit02"
                                                        variant="link"
                                                        color="primary"
                                                    />
                                                </span>
                                            </x-table.td>
                                        </x-table.tr>
                                    @endforeach
                                </x-table.body>
                            </x-table>
                        @endif
                    </x-card.body>

                    @if ($users->hasPages())
                        <x-card.footer>
                            <x-card.footer-child>
                                <span class="text-sm text-zinc-500">
                                    Showing {{ $users->firstItem() }}–{{ $users->lastItem() }} of {{ $users->total() }}
                                </span>
                            </x-card.footer-child>
                            <x-card.footer-child>
                                <x-button
                                    href="{{ $users->url(1) }}"
                                    aria-label="First"
                                    variant="link"
                                    color="zinc"
                                    icon="ArrowLeftDouble"
                                    :is-disable="$users->onFirstPage()"
                                />
                                <x-button
                                    href="{{ $users->previousPageUrl() ?? '#' }}"
                                    aria-label="Previous"
                                    variant="link"
                                    color="zinc"
                                    icon="ArrowLeft01"
                                    :is-disable="$users->onFirstPage()"
                                />
                                <span class="inline-flex items-center gap-1 text-sm">
                                    <span class="text-zinc-500">Page</span>
                                    <strong class="text-zinc-900 dark:text-zinc-100">
                                        {{ $users->currentPage() }} of {{ $users->lastPage() }}
                                    </strong>
                                </span>
                                <x-button
                                    href="{{ $users->nextPageUrl() ?? '#' }}"
                                    aria-label="Next"
                                    variant="link"
                                    color="zinc"
                                    icon="ArrowRight01"
                                    :is-disable="! $users->hasMorePages()"
                                />
                                <x-button
                                    href="{{ $users->url($users->lastPage()) }}"
                                    aria-label="Last"
                                    variant="link"
                                    color="zinc"
                                    icon="ArrowRightDouble"
                                    :is-disable="! $users->hasMorePages()"
                                />
                            </x-card.footer-child>
                        </x-card.footer>
                    @endif
                </x-card>
            </div>
        </div>
    </x-container>
@endsection
