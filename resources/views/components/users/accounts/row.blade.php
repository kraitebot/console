@props([
    'account',
    'form' => [],
    'expanded' => false,
    'connectivity' => null,
    'quoteOptions' => [],
    'leverageOptions' => [],
])

@php
    $accountId = (int) $account['id'];
    $activeColor = $account['is_active'] ? 'emerald' : 'zinc';
    $tradeColor = $account['can_trade'] ? 'primary' : 'amber';
    $formatPercent = static function (mixed $value): string {
        if ($value === null || $value === '') {
            return '-';
        }

        $number = (float) $value;
        $percent = abs($number) <= 1.0 ? $number * 100 : $number;

        return number_format($percent, 2, '.', '').'%';
    };
    $hasAbsoluteMargin = $account['margin'] !== null && $account['margin'] !== '';
    $balanceBasisLabel = ($account['balance_for_trading_basis'] ?? 'total') === 'available'
        ? 'Available Balance'
        : 'Total Balance';
    $formatAmount = static fn (mixed $value): string => $value === null || $value === ''
        ? '-'
        : number_format((float) $value, 2, '.', '');
@endphp

<div
    data-component-name="Users/AccountsRow"
    x-data="{ expanded: @js($expanded), accountTab: 'details' }"
    x-effect="expanded = @js($expanded)"
    class="overflow-hidden rounded-xl border border-zinc-500/15 bg-zinc-50/70 transition-colors duration-300 hover:border-primary-500/35 hover:bg-primary-500/5 dark:bg-zinc-950/60"
>
    <button
        type="button"
        wire:click="toggleAccount({{ $accountId }})"
        @click="expanded = ! expanded"
        class="flex w-full cursor-pointer items-center gap-4 bg-primary-500 px-4 py-4 text-left text-zinc-900 transition-colors duration-300 hover:bg-primary-600"
        :aria-expanded="expanded ? 'true' : 'false'"
    >
        <div class="flex size-11 shrink-0 items-center justify-center rounded-lg bg-zinc-900/10 text-zinc-900">
            <x-icon name="UserAccount" size="text-2xl" />
        </div>

        <div class="min-w-0 flex-1">
            <div class="flex flex-wrap items-center gap-2">
                <div class="truncate text-lg font-semibold text-zinc-900">{{ $account['name'] }}</div>
                <span class="inline-flex rounded-lg border border-zinc-900/10 bg-zinc-900/10 px-2 py-0.5 text-sm font-semibold text-zinc-900">
                    {{ $account['is_active'] ? 'Active' : 'Inactive' }}
                </span>
                <span class="inline-flex rounded-lg border border-zinc-900/10 bg-zinc-900/10 px-2 py-0.5 text-sm font-semibold text-zinc-900">
                    {{ $account['can_trade'] ? 'Can trade' : 'Trading paused' }}
                </span>
            </div>
            <div class="mt-1 flex flex-wrap items-center gap-x-4 gap-y-1 text-base text-zinc-900/70">
                <span>{{ $account['exchange_name'] ?? 'Exchange unknown' }}</span>
                <span>{{ $account['portfolio_quote'] ?? '-' }} portfolio</span>
                <span>{{ $account['open_positions_count'] }} open {{ str('position')->plural($account['open_positions_count']) }}</span>
            </div>
        </div>

        <div class="hidden grid-cols-3 gap-3 text-right lg:grid">
            <div>
                <div class="text-sm text-zinc-900/70">{{ $hasAbsoluteMargin ? 'Margin' : 'Margin %' }}</div>
                <div class="text-base font-semibold text-zinc-900">
                    @if ($hasAbsoluteMargin)
                        {{ $account['margin'] }} {{ $account['trading_quote'] ?? $account['portfolio_quote'] ?? '' }}
                    @else
                        L {{ $formatPercent($account['margin_percentage_long']) }} / S {{ $formatPercent($account['margin_percentage_short']) }}
                    @endif
                </div>
            </div>
            <div>
                <div class="text-sm text-zinc-900/70">Long</div>
                <div class="text-base font-semibold text-zinc-900">{{ $account['position_leverage_long'] }}x</div>
            </div>
            <div>
                <div class="text-sm text-zinc-900/70">Short</div>
                <div class="text-base font-semibold text-zinc-900">{{ $account['position_leverage_short'] }}x</div>
            </div>
        </div>

        <x-icon
            name="ArrowDown01"
            size="text-2xl"
            class="text-zinc-900 transition-transform duration-300"
            x-bind:class="expanded ? 'rotate-180' : ''"
        />
    </button>

    <div x-show="expanded" x-collapse.duration.250ms x-cloak>
        <div class="border-t border-zinc-500/15 bg-white/70 px-4 py-5 dark:bg-zinc-950">
            <div class="mb-5 flex flex-wrap items-center gap-2 border-b border-zinc-500/15 pb-4" role="tablist" aria-label="Account sections">
                <button
                    type="button"
                    @click="accountTab = 'details'"
                    class="users-account-subtab"
                    role="tab"
                    :aria-selected="accountTab === 'details'"
                    :data-active="accountTab === 'details' ? 'true' : 'false'"
                >
                    Details
                </button>
                <button
                    type="button"
                    @click="accountTab = 'connectivity'"
                    class="users-account-subtab"
                    role="tab"
                    :aria-selected="accountTab === 'connectivity'"
                    :data-active="accountTab === 'connectivity' ? 'true' : 'false'"
                >
                    Server connectivity
                </button>
            </div>

            <div x-show="accountTab === 'details'" x-transition.opacity.duration.200ms>
            <div class="mb-5 grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-4">
                <x-data-display.item label="Exchange" :value="$account['exchange_name'] ?? null" />
                <x-data-display.item label="Configuration" :value="$account['trade_configuration_canonical'] ?? null" />
                <x-data-display.item label="Hedge Mode" :value="$account['on_hedge_mode'] ? 'Enabled' : 'Disabled'" />
                <x-data-display.item label="Open Positions" :value="$account['open_positions_count']" />
                <x-data-display.item label="Total Wallet Balance" :value="$formatAmount($account['total_wallet_balance'] ?? null)" />
                <x-data-display.item label="Available Balance" :value="$formatAmount($account['available_balance'] ?? null)" />
                <x-data-display.item label="Trade Using" :value="$balanceBasisLabel" />
                <x-data-display.item label="Balance Used" :value="($account['balance_source'] ?? 'Unavailable').': '.$formatAmount($account['balance_for_trading'] ?? null)" />
                <x-data-display.item label="Absolute Margin Cap" :value="$formatAmount($account['max_margin_amount'] ?? null)" />
            </div>

            @if ($account['disabled_reason'])
                <div class="mb-5 rounded-lg border border-amber-500/25 bg-amber-500/10 px-4 py-3 text-base text-amber-500">
                    {{ $account['disabled_reason'] }}
                </div>
            @endif

            <div class="mb-5 flex items-center gap-4" aria-hidden="true">
                <div class="h-px flex-1 bg-gradient-to-r from-transparent via-primary-500/35 to-zinc-500/10"></div>
                <div class="flex items-center gap-2 rounded-full border border-primary-500/20 bg-primary-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-primary-500">
                    <span class="size-1.5 rounded-full bg-primary-500"></span>
                    Editable settings
                </div>
                <div class="h-px flex-1 bg-gradient-to-l from-transparent via-primary-500/35 to-zinc-500/10"></div>
            </div>

            <form wire:submit="saveAccount({{ $accountId }})" class="grid grid-cols-12 gap-4">
                <div class="col-span-12 lg:col-span-6">
                    <x-form.label for="account-{{ $accountId }}-name" class="!text-base">Name</x-form.label>
                    <x-form.input id="account-{{ $accountId }}-name" name="accountForms.{{ $accountId }}.name" wire:model="accountForms.{{ $accountId }}.name" dimension="lg" />
                    @error("accountForms.{$accountId}.name")
                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <x-form.label for="account-{{ $accountId }}-portfolio" class="!text-base">Portfolio Quote</x-form.label>
                    <x-form.select id="account-{{ $accountId }}-portfolio" name="accountForms.{{ $accountId }}.portfolio_quote" wire:model="accountForms.{{ $accountId }}.portfolio_quote" dimension="lg">
                        <option value="">No quote</option>
                        @foreach ($quoteOptions as $quote)
                            <option value="{{ $quote }}">{{ $quote }}</option>
                        @endforeach
                    </x-form.select>
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Quote currency used to value and report the account portfolio.</p>
                    @error("accountForms.{$accountId}.portfolio_quote")
                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <x-form.label for="account-{{ $accountId }}-trading" class="!text-base">Trading Quote</x-form.label>
                    <x-form.select id="account-{{ $accountId }}-trading" name="accountForms.{{ $accountId }}.trading_quote" wire:model="accountForms.{{ $accountId }}.trading_quote" dimension="lg">
                        <option value="">No quote</option>
                        @foreach ($quoteOptions as $quote)
                            <option value="{{ $quote }}">{{ $quote }}</option>
                        @endforeach
                    </x-form.select>
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Quote currency Kraite uses when selecting tradable market pairs.</p>
                    @error("accountForms.{$accountId}.trading_quote")
                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <x-form.label for="account-{{ $accountId }}-balance-basis" class="!text-base">Trade Using</x-form.label>
                    <x-form.select id="account-{{ $accountId }}-balance-basis" name="accountForms.{{ $accountId }}.balance_for_trading_basis" wire:model="accountForms.{{ $accountId }}.balance_for_trading_basis" dimension="lg">
                        <option value="total">Total Balance</option>
                        <option value="available">Available Balance</option>
                    </x-form.select>
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Balance source used by Kraite when sizing new position margin.</p>
                    @error("accountForms.{$accountId}.balance_for_trading_basis")
                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <x-form.label for="account-{{ $accountId }}-margin" class="!text-base">Margin</x-form.label>
                    <x-form.input id="account-{{ $accountId }}-margin" type="number" name="accountForms.{{ $accountId }}.margin" wire:model="accountForms.{{ $accountId }}.margin" wire:blur="clearAccountMarginPercentages({{ $accountId }})" dimension="lg" />
                    <p class="mt-2 text-sm leading-5 text-zinc-500">
                        Optional absolute margin. Max 5% of total wallet balance{{ isset($account['max_margin_amount']) && $account['max_margin_amount'] !== null ? ': '.$formatAmount($account['max_margin_amount']) : ' when balance is available' }}.
                    </p>
                    @error("accountForms.{$accountId}.margin")
                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <x-form.label for="account-{{ $accountId }}-mode" class="!text-base">Margin Mode</x-form.label>
                    <x-form.select id="account-{{ $accountId }}-mode" name="accountForms.{{ $accountId }}.margin_mode" wire:model="accountForms.{{ $accountId }}.margin_mode" dimension="lg">
                        <option value="crossed">Crossed</option>
                        <option value="isolated">Isolated</option>
                    </x-form.select>
                    @error("accountForms.{$accountId}.margin_mode")
                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <x-form.label for="account-{{ $accountId }}-long" class="!text-base">Long Leverage</x-form.label>
                    <x-form.select id="account-{{ $accountId }}-long" name="accountForms.{{ $accountId }}.position_leverage_long" wire:model="accountForms.{{ $accountId }}.position_leverage_long" dimension="lg">
                        @foreach ($leverageOptions as $leverage)
                            <option value="{{ $leverage }}">{{ $leverage }}x</option>
                        @endforeach
                    </x-form.select>
                    @error("accountForms.{$accountId}.position_leverage_long")
                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <x-form.label for="account-{{ $accountId }}-short" class="!text-base">Short Leverage</x-form.label>
                    <x-form.select id="account-{{ $accountId }}-short" name="accountForms.{{ $accountId }}.position_leverage_short" wire:model="accountForms.{{ $accountId }}.position_leverage_short" dimension="lg">
                        @foreach ($leverageOptions as $leverage)
                            <option value="{{ $leverage }}">{{ $leverage }}x</option>
                        @endforeach
                    </x-form.select>
                    @error("accountForms.{$accountId}.position_leverage_short")
                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <x-form.label for="account-{{ $accountId }}-long-margin" class="!text-base">Long Margin %</x-form.label>
                    <x-form.input id="account-{{ $accountId }}-long-margin" name="accountForms.{{ $accountId }}.margin_percentage_long" wire:model="accountForms.{{ $accountId }}.margin_percentage_long" wire:blur="clearAccountAbsoluteMargin({{ $accountId }})" dimension="lg" inputmode="decimal" placeholder="5.00" />
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Required when absolute margin is empty. Allowed range: 1.00% to 5.00%.</p>
                    @error("accountForms.{$accountId}.margin_percentage_long")
                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <x-form.label for="account-{{ $accountId }}-short-margin" class="!text-base">Short Margin %</x-form.label>
                    <x-form.input id="account-{{ $accountId }}-short-margin" name="accountForms.{{ $accountId }}.margin_percentage_short" wire:model="accountForms.{{ $accountId }}.margin_percentage_short" wire:blur="clearAccountAbsoluteMargin({{ $accountId }})" dimension="lg" inputmode="decimal" placeholder="5.00" />
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Required when absolute margin is empty. Allowed range: 1.00% to 5.00%.</p>
                    @error("accountForms.{$accountId}.margin_percentage_short")
                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-12 grid gap-3 md:grid-cols-2 xl:grid-cols-4">
                    <div>
                        <x-form.checkbox id="account-{{ $accountId }}-active" name="accountForms.{{ $accountId }}.is_active" wire:model="accountForms.{{ $accountId }}.is_active" label="Active account" color="primary" />
                        <p class="mt-2 text-sm leading-5 text-zinc-500">Makes this account available for Kraite operations.</p>
                    </div>
                    <div>
                        <x-form.checkbox id="account-{{ $accountId }}-trade" name="accountForms.{{ $accountId }}.can_trade" wire:model="accountForms.{{ $accountId }}.can_trade" label="Can trade" color="primary" />
                        <p class="mt-2 text-sm leading-5 text-zinc-500">Allows Kraite to dispatch new positions for this account.</p>
                    </div>
                    <div>
                        <x-form.checkbox id="account-{{ $accountId }}-positions" name="accountForms.{{ $accountId }}.allow_other_positions" wire:model="accountForms.{{ $accountId }}.allow_other_positions" label="Allow other positions" color="primary" />
                        <p class="mt-2 text-sm leading-5 text-zinc-500">Keeps manual exchange positions instead of closing unknown ones.</p>
                    </div>
                    <div>
                        <x-form.checkbox id="account-{{ $accountId }}-orders" name="accountForms.{{ $accountId }}.allow_other_orders" wire:model="accountForms.{{ $accountId }}.allow_other_orders" label="Allow other orders" color="primary" />
                        <p class="mt-2 text-sm leading-5 text-zinc-500">Keeps manual exchange orders instead of cancelling unknown ones.</p>
                    </div>
                </div>

                <div class="col-span-12 flex items-center justify-end gap-3 border-t border-zinc-500/15 pt-4">
                    <div
                        wire:loading.flex
                        wire:target="saveAccount({{ $accountId }})"
                        class="items-center gap-2 text-base text-zinc-500"
                    >
                        <span class="size-4 animate-spin rounded-full border-2 border-primary-500/20 border-t-primary-500"></span>
                        Saving
                    </div>
                    <x-button type="submit" variant="solid" color="primary" icon="FloppyDisk" dimension="lg">
                        Save Account
                    </x-button>
                </div>
            </form>
            </div>

            <div x-show="accountTab === 'connectivity'" x-transition.opacity.duration.200ms x-cloak>
                @if ($connectivity && ! ($connectivity['is_complete'] ?? false))
                    <div wire:poll.1s="pollAccountConnectivity({{ $accountId }})" class="hidden"></div>
                @endif

                <div class="flex flex-col gap-3 rounded-xl border border-zinc-500/15 bg-zinc-950/[0.02] p-4 dark:bg-white/[0.02] md:flex-row md:items-center md:justify-between">
                    <div class="flex min-w-0 items-start gap-3">
                        <div class="flex size-10 shrink-0 items-center justify-center rounded-lg border border-primary-500/25 bg-primary-500/10 text-primary-500">
                            <x-icon name="Computer" size="text-2xl" />
                        </div>
                        <div class="min-w-0">
                            <div class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Server connectivity</div>
                            <p class="mt-1 text-sm leading-5 text-zinc-500">
                                Test exchange API access from each API execution server using this account credentials.
                            </p>
                        </div>
                    </div>

                    <x-button
                        type="button"
                        variant="solid"
                        color="primary"
                        icon="Loading03"
                        dimension="lg"
                        wire:click="startAccountConnectivity({{ $accountId }})"
                        wire:loading.attr="disabled"
                        wire:target="startAccountConnectivity({{ $accountId }})"
                    >
                        <span wire:loading.remove wire:target="startAccountConnectivity({{ $accountId }})">Test servers connectivity</span>
                        <span wire:loading wire:target="startAccountConnectivity({{ $accountId }})">Starting...</span>
                    </x-button>
                </div>

                @if ($connectivity)
                    <div class="mt-3 overflow-hidden rounded-xl border border-zinc-500/15">
                        @forelse (($connectivity['servers'] ?? []) as $server)
                            @php
                                $status = $server['status'] ?? 'testing';
                                $statusClasses = match ($status) {
                                    'connected' => 'border-primary-500/25 bg-primary-500/10 text-primary-500',
                                    'not_connected' => 'border-red-500/25 bg-red-500/10 text-red-500',
                                    default => 'border-amber-500/25 bg-amber-500/10 text-amber-500',
                                };
                                $statusLabel = match ($status) {
                                    'connected' => 'Connected',
                                    'not_connected' => 'Not connected',
                                    default => 'Testing',
                                };
                            @endphp

                            <div class="flex flex-col gap-3 border-b border-zinc-500/10 bg-white/60 px-4 py-3 last:border-b-0 dark:bg-zinc-950/60 md:flex-row md:items-center md:justify-between">
                                <div class="flex min-w-0 items-center gap-3">
                                    <div class="flex size-9 shrink-0 items-center justify-center rounded-lg border border-zinc-500/15 bg-zinc-500/10 text-zinc-500">
                                        <x-icon name="Computer" size="text-xl" />
                                    </div>
                                    <div class="min-w-0">
                                        <div class="truncate text-base font-semibold text-zinc-900 dark:text-zinc-100">{{ $server['hostname'] }}</div>
                                        <div class="mt-0.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-zinc-500">
                                            <span>{{ $server['ip_address'] }}</span>
                                            <span>Queue {{ $server['queue'] }}</span>
                                        </div>
                                        @if (! empty($server['error_message']))
                                            <div class="mt-1 text-sm text-red-500/80">{{ $server['error_message'] }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex shrink-0 items-center gap-2">
                                    <span class="inline-flex items-center gap-2 rounded-lg border px-3 py-1 text-sm font-semibold {{ $statusClasses }}">
                                        @if ($status === 'testing')
                                            <span class="size-3 animate-spin rounded-full border-2 border-current/25 border-t-current"></span>
                                        @else
                                            <span class="size-2 rounded-full bg-current"></span>
                                        @endif
                                        {{ $statusLabel }}
                                    </span>

                                    @if ($server['can_notify_user'] ?? false)
                                        <x-button
                                            type="button"
                                            variant="outline"
                                            color="primary"
                                            icon="Notification03"
                                            dimension="sm"
                                            wire:click="sendConnectivityNotification({{ $accountId }}, {{ (int) $server['id'] }})"
                                            wire:loading.attr="disabled"
                                            wire:target="sendConnectivityNotification({{ $accountId }}, {{ (int) $server['id'] }})"
                                        >
                                            Send User notification
                                        </x-button>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-5 text-center text-sm text-zinc-500">No API execution servers configured.</div>
                        @endforelse
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
