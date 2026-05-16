@props([
    'accounts' => [],
    'selectedAccountId' => null,
    'data' => null,
    'history' => [],
    'historyPage' => 1,
    'historyLastPage' => 1,
    'historyTotal' => 0,
    'onlyDrifts' => false,
    'expandedPairs' => [],
    'expandedHistory' => [],
])

@php
    $pairs = collect($data['pairs'] ?? []);
    $orphanOrders = collect($data['orphan_orders'] ?? []);
    $visiblePairs = $onlyDrifts
        ? $pairs->filter(fn ($pair) => ! in_array($pair['status'], ['synced', 'transient'], true))
        : $pairs;
    $dbPositionCount = $pairs->filter(fn ($pair) => filled($pair['db'] ?? null))->count();
    $exchangePositionCount = $pairs->filter(fn ($pair) => filled($pair['exchange'] ?? null))->count();
    $totalOrderCount = $pairs->sum(fn ($pair) => $pair['order_counts']['total'] ?? 0) + $orphanOrders->count();
    $driftCount = $pairs->filter(fn ($pair) => ! in_array($pair['status'], ['synced', 'transient'], true))->count() + $orphanOrders->count();
    $selectedAccount = collect($accounts)->firstWhere('id', $selectedAccountId);
    $statusColors = [
        'synced' => 'emerald',
        'drift' => 'amber',
        'db_only' => 'red',
        'exchange_only' => 'amber',
        'transient' => 'blue',
    ];
    $statusLabels = [
        'synced' => 'Synced',
        'drift' => 'Drift',
        'db_only' => 'DB only',
        'exchange_only' => 'Exchange only',
        'transient' => 'Transient',
    ];
    $formatPnl = fn ($value) => $value === null || $value === '' ? '-' : (((float) $value > 0 ? '+' : '').number_format((float) $value, 4, '.', ''));
    $pnlClass = fn ($value) => $value === null || $value === '' ? 'text-zinc-500' : ((float) $value > 0 ? 'text-emerald-400' : ((float) $value < 0 ? 'text-red-400' : 'text-zinc-400'));
@endphp

<div data-component-name="Users/PositionsPanel" class="space-y-6">
    <x-card>
        <x-card.header>
            <x-card.header-child>
                <x-card.title>
                    <x-icon name="ProductLoading" color="primary" size="text-3xl" />
                    <div>
                        <div>Positions</div>
                        <x-card.subtitle>Database and exchange reconciliation</x-card.subtitle>
                    </div>
                </x-card.title>
            </x-card.header-child>
            <x-card.header-child>
                <div class="flex items-center gap-3">
                    @if (count($accounts) > 1)
                        <x-form.select
                            id="position_account"
                            name="position_account"
                            wire:change="selectPositionAccount($event.target.value)"
                            dimension="lg"
                        >
                            @foreach ($accounts as $account)
                                <option value="{{ $account['id'] }}" @selected((int) $selectedAccountId === (int) $account['id'])>
                                    {{ $account['name'] }} - {{ $account['exchange'] }}
                                </option>
                            @endforeach
                        </x-form.select>
                    @endif
                    @if ($selectedAccountId)
                        <x-button wire:click="refreshPositions" wire:loading.attr="disabled" wire:target="refreshPositions" color="primary" icon="Refresh">
                            Refresh
                        </x-button>
                    @endif
                </div>
            </x-card.header-child>
        </x-card.header>

        <x-card.body>
            @if (count($accounts) === 0)
                <x-empty title="No accounts" description="This user has no linked exchange accounts." />
            @elseif (! $data)
                <div class="flex items-center justify-center py-16">
                    <span class="size-6 animate-spin rounded-full border-2 border-primary-500/20 border-t-primary-500"></span>
                </div>
            @else
                <div class="space-y-6">
                    @if ($data['api_error'] ?? null)
                        <div class="rounded-lg border border-amber-500/20 bg-amber-500/10 px-4 py-3 text-sm text-amber-300">
                            {{ $data['api_error'] }}
                        </div>
                    @endif

                    <div class="overflow-hidden rounded-lg border border-zinc-800 bg-zinc-950">
                        <div class="flex flex-col gap-4 p-5 lg:flex-row lg:items-center">
                            <div class="flex flex-1 items-center gap-4">
                                <div class="flex size-12 items-center justify-center overflow-hidden rounded-lg bg-zinc-900">
                                    @if ($selectedAccount['exchange_logo'] ?? null)
                                        <img src="{{ $selectedAccount['exchange_logo'] }}" alt="{{ $selectedAccount['exchange'] }}" class="size-full object-contain">
                                    @else
                                        <span class="text-lg font-bold text-zinc-500">{{ str($selectedAccount['name'] ?? '?')->substr(0, 1)->upper() }}</span>
                                    @endif
                                </div>
                                <div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-lg font-semibold text-zinc-100">{{ $selectedAccount['name'] ?? 'Account' }}</h3>
                                        <x-badge :color="($selectedAccount['can_trade'] ?? false) ? 'emerald' : 'red'">
                                            {{ ($selectedAccount['can_trade'] ?? false) ? 'Active' : 'Inactive' }}
                                        </x-badge>
                                        <x-badge :color="$driftCount === 0 ? 'emerald' : 'amber'">
                                            {{ $driftCount === 0 ? 'In sync' : $driftCount.' drift' }}
                                        </x-badge>
                                    </div>
                                    <div class="mt-1 font-mono text-sm text-zinc-500">{{ $selectedAccount['exchange'] ?? 'Unknown exchange' }}</div>
                                </div>
                            </div>

                            <div class="grid grid-cols-4 overflow-hidden rounded-lg border border-zinc-800">
                                <x-users.positions.stat label="DB Pos" :value="$dbPositionCount" />
                                <x-users.positions.stat label="Ex Pos" :value="$exchangePositionCount" />
                                <x-users.positions.stat label="Orders" :value="$totalOrderCount" />
                                <x-users.positions.stat label="Drift" :value="$driftCount" :danger="$driftCount > 0" />
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div>
                            <h3 class="text-base font-semibold text-zinc-100">Open positions</h3>
                            <p class="font-mono text-sm text-zinc-500">{{ $visiblePairs->count() }} / {{ $pairs->count() }}</p>
                        </div>
                        <span class="flex-1"></span>
                        <label class="flex cursor-pointer items-center gap-2 text-sm text-zinc-400">
                            <input type="checkbox" wire:model.live="onlyPositionDrifts" class="size-4 rounded border-zinc-700 bg-zinc-900 text-primary-500 focus:ring-primary-500">
                            Only drifts
                        </label>
                    </div>

                    @if ($pairs->isEmpty())
                        <div class="rounded-lg border border-zinc-800 bg-zinc-950 px-5 py-4 text-zinc-500">No open positions.</div>
                    @elseif ($visiblePairs->isEmpty())
                        <div class="rounded-lg border border-zinc-800 bg-zinc-950 px-5 py-4 text-zinc-500">All positions are in sync.</div>
                    @endif

                    <div class="space-y-2">
                        @foreach ($visiblePairs as $pair)
                            @php
                                $pairKey = $pair['symbol'].'|'.$pair['direction'];
                                $isOpen = $expandedPairs[$pairKey] ?? false;
                                $status = $pair['status'];
                            @endphp
                            <div class="overflow-hidden rounded-lg border border-zinc-800 bg-zinc-950">
                                <button type="button" wire:click="togglePositionPair('{{ $pairKey }}')" class="flex w-full items-center gap-3 px-4 py-3 text-left transition-colors hover:bg-primary-500/5">
                                    <x-icon name="ArrowRight01" class="{{ $isOpen ? 'rotate-90' : '' }} text-zinc-500 transition-transform" />
                                    <div class="flex size-7 items-center justify-center overflow-hidden rounded-full bg-zinc-900">
                                        @if ($pair['token_image'])
                                            <img src="{{ $pair['token_image'] }}" alt="{{ $pair['token'] }}" class="size-full object-cover">
                                        @else
                                            <span class="text-xs font-bold text-zinc-500">{{ str($pair['token'] ?? $pair['symbol'])->substr(0, 3)->upper() }}</span>
                                        @endif
                                    </div>
                                    <span class="font-mono text-base font-semibold text-zinc-100">{{ $pair['symbol'] }}</span>
                                    <x-badge :color="$pair['direction'] === 'LONG' ? 'emerald' : 'red'">{{ $pair['direction'] }}</x-badge>
                                    @if ($pair['db']['opened_seconds_ago'] ?? null)
                                        <span class="hidden font-mono text-sm text-zinc-500 sm:inline">{{ floor($pair['db']['opened_seconds_ago'] / 60) }}m ago</span>
                                    @endif
                                    <span class="flex-1"></span>
                                    <span class="hidden font-mono text-sm text-zinc-500 sm:inline">{{ $pair['order_counts']['total'] }} orders</span>
                                    <x-badge :color="$statusColors[$status] ?? 'zinc'">{{ $statusLabels[$status] ?? ucfirst($status) }}</x-badge>
                                </button>

                                @if ($isOpen)
                                    <div class="border-t border-zinc-800">
                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <x-users.positions.side title="Database" :position="$pair['db']" />
                                            <x-users.positions.side title="Exchange" :position="$pair['exchange']" exchange />
                                        </div>

                                        @if (count($pair['orders']) > 0)
                                            <x-users.positions.orders :orders="$pair['orders']" />
                                        @endif

                                        <x-users.positions.projections :rows="$pair['pnl_projections']" />
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>

                    <div class="space-y-3 pt-4">
                        <div class="flex items-center gap-2">
                            <h3 class="text-base font-semibold text-zinc-100">All positions</h3>
                            <span class="font-mono text-sm text-zinc-500">{{ $historyTotal }}</span>
                        </div>

                        <div class="overflow-hidden rounded-lg border border-zinc-800 bg-zinc-950">
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-[980px] font-mono text-sm">
                                    <thead class="bg-primary-500 text-zinc-950">
                                        <tr>
                                            <th class="w-10 px-4 py-3"></th>
                                            <th class="px-3 py-3 text-left">Symbol</th>
                                            <th class="px-3 py-3 text-left">Dir</th>
                                            <th class="px-3 py-3 text-left">Status</th>
                                            <th class="px-3 py-3 text-right">Qty</th>
                                            <th class="px-3 py-3 text-right">Entry</th>
                                            <th class="px-3 py-3 text-right">Exit</th>
                                            <th class="px-3 py-3 text-right">Lev</th>
                                            <th class="px-3 py-3 text-right">PnL</th>
                                            <th class="px-3 py-3 text-right">Orders</th>
                                            <th class="px-4 py-3 text-left">Opened</th>
                                        </tr>
                                    </thead>
                                    @forelse ($history as $position)
                                        @php $historyOpen = $expandedHistory[$position['id']] ?? false; @endphp
                                        <tbody>
                                            <tr wire:click="togglePositionHistory({{ $position['id'] }})" class="cursor-pointer border-t border-zinc-900 transition-colors hover:bg-primary-500/5">
                                                <td class="px-4 py-3"><x-icon name="ArrowRight01" class="{{ $historyOpen ? 'rotate-90' : '' }} text-zinc-500 transition-transform" /></td>
                                                <td class="px-3 py-3 font-semibold text-zinc-100">{{ $position['symbol'] }}</td>
                                                <td class="px-3 py-3"><x-badge :color="$position['direction'] === 'LONG' ? 'emerald' : 'red'">{{ $position['direction'] }}</x-badge></td>
                                                <td class="px-3 py-3 text-zinc-400">{{ $position['status'] }}</td>
                                                <td class="px-3 py-3 text-right text-zinc-300">{{ $position['quantity'] ?: '-' }}</td>
                                                <td class="px-3 py-3 text-right text-zinc-300">{{ $position['opening_price'] ?: '-' }}</td>
                                                <td class="px-3 py-3 text-right text-zinc-500">{{ $position['closing_price'] ?: '-' }}</td>
                                                <td class="px-3 py-3 text-right text-zinc-500">{{ $position['leverage'] }}x</td>
                                                <td class="px-3 py-3 text-right {{ $pnlClass($position['pnl']) }}">{{ $formatPnl($position['pnl']) }}</td>
                                                <td class="px-3 py-3 text-right text-zinc-500">{{ $position['order_count'] }}</td>
                                                <td class="px-4 py-3 text-zinc-500">{{ $position['created_at'] ?: '-' }}</td>
                                            </tr>
                                            @if ($historyOpen)
                                                <tr class="border-t border-zinc-900 bg-zinc-900/40">
                                                    <td></td>
                                                    <td colspan="10" class="px-3 py-4">
                                                        <x-users.positions.orders :orders="collect($position['orders'])->map(fn ($order) => ['status' => 'synced', 'db' => $order, 'exchange' => null, 'drift_fields' => []])->all()" compact />
                                                        <x-users.positions.projections :rows="$position['pnl_projections']" compact />
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    @empty
                                        <tbody>
                                            <tr>
                                                <td colspan="11" class="px-4 py-6 text-center text-zinc-500">No positions recorded for this account.</td>
                                            </tr>
                                        </tbody>
                                    @endforelse
                                </table>
                            </div>

                            @if ($historyLastPage > 1)
                                <div class="flex items-center justify-end gap-2 border-t border-zinc-800 px-4 py-3">
                                    <x-button wire:click="loadPositionHistory({{ max(1, $historyPage - 1) }})" variant="ghost" color="zinc" :disabled="$historyPage <= 1">Previous</x-button>
                                    <span class="font-mono text-sm text-zinc-500">Page {{ $historyPage }} of {{ $historyLastPage }}</span>
                                    <x-button wire:click="loadPositionHistory({{ min($historyLastPage, $historyPage + 1) }})" variant="ghost" color="zinc" :disabled="$historyPage >= $historyLastPage">Next</x-button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </x-card.body>
    </x-card>
</div>
