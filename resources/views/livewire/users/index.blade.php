<div data-component-name="UsersIndex" class="flex flex-1 flex-col">
    <x-flash-toast :message="$flashToastMessage" />

    @section('header-left')
        <x-breadcrumb
            :list="[['text' => 'Entities'], config('menu.entities.users')]"
            home-path="/dashboard"
        />
    @endsection

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
                        <x-card.header-child class="w-full sm:w-auto sm:ms-auto">
                            <div class="w-full sm:w-80">
                                <x-form.field-wrap>
                                    <x-form.input
                                        name="q"
                                        data-livewire-search="searchFor"
                                        data-livewire-component="users.users-index"
                                        :value="$search"
                                        variant="solid"
                                        dimension="sm"
                                        placeholder="Search users..."
                                    />
                                </x-form.field-wrap>
                            </div>
                            <x-button
                                href="{{ route('users.create') }}"
                                wire:navigate
                                aria-label="New User"
                                variant="soft"
                                color="primary"
                                icon="UserAdd02"
                            >
                                New User
                            </x-button>
                        </x-card.header-child>
                    </x-card.header>

                    <x-card.body class="overflow-auto">
                        @if ($users->isEmpty())
                            <x-empty />
                        @else
                            @php
                                $headerCellClass = '!bg-primary-500 !text-zinc-900 dark:!bg-primary-500 dark:!text-zinc-900';
                            @endphp
                            <x-table>
                                <x-table.head>
                                    <x-table.tr>
                                        <x-table.th class="w-12 text-left {{ $headerCellClass }}" :is-column-border="false">Avatar</x-table.th>
                                        @foreach ($columns as $column)
                                            @php
                                                $col = $column['key'];
                                                $isActive = $sort === $col;
                                                $sortIcon = ! $isActive
                                                    ? 'Sorting05'
                                                    : ($direction === 'asc' ? 'Sorting02' : 'Sorting01');
                                            @endphp
                                            <x-table.th class="text-left {{ $headerCellClass }}" :is-column-border="false">
                                                <button
                                                    type="button"
                                                    wire:click="sortBy('{{ $col }}')"
                                                    class="inline-flex cursor-pointer items-center gap-2 select-none"
                                                >
                                                    {{ $column['label'] }}
                                                    <x-icon :name="$sortIcon" :color="$isActive ? 'blue' : 'zinc'" />
                                                </button>
                                            </x-table.th>
                                        @endforeach
                                        <x-table.th class="text-right {{ $headerCellClass }}" :is-column-border="false">Actions</x-table.th>
                                    </x-table.tr>
                                </x-table.head>

                                <x-table.body>
                                    @foreach ($users as $user)
                                        @php
                                            $colors = ['primary', 'secondary', 'blue', 'emerald', 'amber', 'violet', 'sky', 'lime', 'red'];
                                            $avatarColor = $colors[crc32($user->email) % count($colors)];
                                            $rowUrl = route('users.show', $user);
                                            $statusColor = match ($user->status) {
                                                'active' => 'emerald',
                                                'confirmed' => 'blue',
                                                'pending' => 'amber',
                                                default => 'zinc',
                                            };
                                        @endphp
                                        <x-table.tr
                                            wire:key="user-row-{{ $user->id }}"
                                            class="cursor-pointer"
                                            x-data
                                            @click="Livewire.navigate('{{ $rowUrl }}')"
                                        >
                                            <x-table.td class="py-5">
                                                <x-avatar :src="$user->avatar" :name="$user->name" size="w-10" :color="$avatarColor" variant="soft" />
                                            </x-table.td>
                                            <x-table.td class="py-5 font-semibold text-zinc-900 dark:text-zinc-100">
                                                {{ $user->name }}
                                            </x-table.td>
                                            <x-table.td class="py-5 text-zinc-500">{{ $user->email }}</x-table.td>
                                            <x-table.td class="py-5">
                                                @if ($user->is_admin)
                                                    <x-badge variant="soft" color="primary">Admin</x-badge>
                                                @else
                                                    <x-badge variant="soft" color="zinc">User</x-badge>
                                                @endif
                                            </x-table.td>
                                            <x-table.td class="py-5">
                                                <x-badge variant="soft" :color="$statusColor">
                                                    {{ ucfirst($user->status ?? 'unknown') }}
                                                </x-badge>
                                            </x-table.td>
                                            <x-table.td class="py-5 text-zinc-500">
                                                {{ $user->created_at?->diffForHumans() ?? '-' }}
                                            </x-table.td>
                                            <x-table.td class="py-5 text-right">
                                                <span @click.stop>
                                                    <x-button
                                                        href="{{ $rowUrl }}"
                                                        wire:navigate
                                                        aria-label="Edit user"
                                                        icon="PencilEdit02"
                                                        variant="link"
                                                        color="primary"
                                                        dimension="lg"
                                                        class="!text-primary-500 hover:!text-primary-400"
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
                                    Showing {{ $users->firstItem() }}-{{ $users->lastItem() }} of {{ $users->total() }}
                                </span>
                            </x-card.footer-child>
                            <x-card.footer-child>
                                <button
                                    type="button"
                                    wire:click="gotoPage(1)"
                                    aria-label="First"
                                    @disabled($users->onFirstPage())
                                    class="inline-flex cursor-pointer items-center justify-center rounded-lg border border-transparent bg-transparent px-1.5 py-1.5 text-base text-zinc-500 transition-all duration-300 ease-in-out hover:text-zinc-400 disabled:pointer-events-none disabled:opacity-50"
                                >
                                    <x-icon name="ArrowLeftDouble" />
                                </button>
                                <button
                                    type="button"
                                    wire:click="previousPage"
                                    aria-label="Previous"
                                    @disabled($users->onFirstPage())
                                    class="inline-flex cursor-pointer items-center justify-center rounded-lg border border-transparent bg-transparent px-1.5 py-1.5 text-base text-zinc-500 transition-all duration-300 ease-in-out hover:text-zinc-400 disabled:pointer-events-none disabled:opacity-50"
                                >
                                    <x-icon name="ArrowLeft01" />
                                </button>
                                <span class="inline-flex items-center gap-1 text-sm">
                                    <span class="text-zinc-500">Page</span>
                                    <strong class="text-zinc-900 dark:text-zinc-100">
                                        {{ $users->currentPage() }} of {{ $users->lastPage() }}
                                    </strong>
                                </span>
                                <button
                                    type="button"
                                    wire:click="nextPage"
                                    aria-label="Next"
                                    @disabled(! $users->hasMorePages())
                                    class="inline-flex cursor-pointer items-center justify-center rounded-lg border border-transparent bg-transparent px-1.5 py-1.5 text-base text-zinc-500 transition-all duration-300 ease-in-out hover:text-zinc-400 disabled:pointer-events-none disabled:opacity-50"
                                >
                                    <x-icon name="ArrowRight01" />
                                </button>
                                <button
                                    type="button"
                                    wire:click="gotoPage({{ $users->lastPage() }})"
                                    aria-label="Last"
                                    @disabled(! $users->hasMorePages())
                                    class="inline-flex cursor-pointer items-center justify-center rounded-lg border border-transparent bg-transparent px-1.5 py-1.5 text-base text-zinc-500 transition-all duration-300 ease-in-out hover:text-zinc-400 disabled:pointer-events-none disabled:opacity-50"
                                >
                                    <x-icon name="ArrowRightDouble" />
                                </button>
                            </x-card.footer-child>
                        </x-card.footer>
                    @endif
                </x-card>
            </div>
        </div>
    </x-container>
</div>
