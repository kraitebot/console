@props([
    'isOpen' => false,
    'form' => [],
    'apiSystemOptions' => [],
    'tradeConfigurationOptions' => [],
    'quoteOptions' => [],
    'leverageOptions' => [],
])

@if ($isOpen)
@php
    $selectedApiSystemId = (int) ($form['api_system_id'] ?? 0);
    $selectedApiSystem = collect($apiSystemOptions)->firstWhere('id', $selectedApiSystemId);
    $selectedExchange = $selectedApiSystem['canonical'] ?? null;
    $credentialFields = match ($selectedExchange) {
        'binance', 'bybit' => [
            ['field' => 'api_key', 'label' => 'API Key', 'id' => 'new-account-api-key'],
            ['field' => 'api_secret', 'label' => 'API Secret', 'id' => 'new-account-api-secret'],
        ],
        'kucoin', 'bitget' => [
            ['field' => 'api_key', 'label' => 'API Key', 'id' => 'new-account-api-key'],
            ['field' => 'api_secret', 'label' => 'API Secret', 'id' => 'new-account-api-secret'],
            ['field' => 'api_passphrase', 'label' => 'Passphrase', 'id' => 'new-account-api-passphrase'],
        ],
        'kraken' => [
            ['field' => 'api_key', 'label' => 'API Key', 'id' => 'new-account-api-key'],
            ['field' => 'api_secret', 'label' => 'Private Key', 'id' => 'new-account-api-secret'],
        ],
        default => [],
    };
    $credentialGridClass = count($credentialFields) === 3 ? 'lg:grid-cols-3' : 'lg:grid-cols-2';
@endphp
<div
    data-component-name="Users/AccountsCreateForm"
    wire:key="users-accounts-create-form"
    wire:transition.opacity.duration.200ms
    class="mb-4 overflow-hidden rounded-xl border border-primary-500/25 bg-primary-500/5"
>
    <form wire:submit="saveNewAccount" class="p-4">
        <div class="mb-5 flex items-start justify-between gap-4">
            <div class="flex min-w-0 items-start gap-3">
                <div class="flex size-11 shrink-0 items-center justify-center rounded-lg border border-primary-500/25 bg-primary-500/10 text-primary-500">
                    <x-icon name="PlusSignCircle" size="text-2xl" />
                </div>
                <div class="min-w-0">
                    <div class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Create account</div>
                    <p class="mt-1 text-sm leading-5 text-zinc-500">Add exchange settings and optional API credentials for this user.</p>
                </div>
            </div>
            <x-button type="button" variant="outline" color="zinc" wire:click="cancelCreateAccount">
                Cancel
            </x-button>
        </div>

        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12 lg:col-span-6">
                <x-form.label for="new-account-name" class="!text-base">Name</x-form.label>
                <x-form.input id="new-account-name" name="newAccountForm.name" wire:model="newAccountForm.name" dimension="lg" placeholder="Main Binance Account" />
                @error('newAccountForm.name')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-api-system" class="!text-base">Exchange</x-form.label>
                <x-form.select id="new-account-api-system" name="newAccountForm.api_system_id" wire:model="newAccountForm.api_system_id" wire:change="refreshNewAccountQuoteOptions" dimension="lg">
                    @foreach ($apiSystemOptions as $apiSystem)
                        <option value="{{ $apiSystem['id'] }}">{{ $apiSystem['name'] }}</option>
                    @endforeach
                </x-form.select>
                @error('newAccountForm.api_system_id')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-configuration" class="!text-base">Configuration</x-form.label>
                <x-form.select id="new-account-configuration" name="newAccountForm.trade_configuration_id" wire:model="newAccountForm.trade_configuration_id" dimension="lg">
                    @foreach ($tradeConfigurationOptions as $configuration)
                        <option value="{{ $configuration['id'] }}">{{ $configuration['canonical'] }}</option>
                    @endforeach
                </x-form.select>
                @error('newAccountForm.trade_configuration_id')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-portfolio" class="!text-base">Portfolio Quote</x-form.label>
                <x-form.select id="new-account-portfolio" name="newAccountForm.portfolio_quote" wire:model="newAccountForm.portfolio_quote" dimension="lg">
                    @foreach ($quoteOptions as $quote)
                        <option value="{{ $quote }}">{{ $quote }}</option>
                    @endforeach
                </x-form.select>
                <p class="mt-2 text-sm leading-5 text-zinc-500">Quote currency used to value and report the account portfolio.</p>
                @error('newAccountForm.portfolio_quote')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-trading" class="!text-base">Trading Quote</x-form.label>
                <x-form.select id="new-account-trading" name="newAccountForm.trading_quote" wire:model="newAccountForm.trading_quote" dimension="lg">
                    @foreach ($quoteOptions as $quote)
                        <option value="{{ $quote }}">{{ $quote }}</option>
                    @endforeach
                </x-form.select>
                <p class="mt-2 text-sm leading-5 text-zinc-500">Quote currency Kraite uses when selecting tradable market pairs.</p>
                @error('newAccountForm.trading_quote')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-balance-basis" class="!text-base">Trade Using</x-form.label>
                <x-form.select id="new-account-balance-basis" name="newAccountForm.balance_for_trading_basis" wire:model="newAccountForm.balance_for_trading_basis" dimension="lg">
                    <option value="total">Total Balance</option>
                    <option value="available">Available Balance</option>
                </x-form.select>
                <p class="mt-2 text-sm leading-5 text-zinc-500">Balance source used by Kraite when sizing new position margin.</p>
                @error('newAccountForm.balance_for_trading_basis')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-margin" class="!text-base">Margin</x-form.label>
                <x-form.input id="new-account-margin" type="number" name="newAccountForm.margin" wire:model="newAccountForm.margin" wire:blur="clearNewAccountMarginPercentages" dimension="lg" inputmode="decimal" />
                <p class="mt-2 text-sm leading-5 text-zinc-500">Optional absolute margin. Leave empty to use margin percentages.</p>
                @error('newAccountForm.margin')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-mode" class="!text-base">Margin Mode</x-form.label>
                <x-form.select id="new-account-mode" name="newAccountForm.margin_mode" wire:model="newAccountForm.margin_mode" dimension="lg">
                    <option value="crossed">Crossed</option>
                    <option value="isolated">Isolated</option>
                </x-form.select>
                @error('newAccountForm.margin_mode')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-long-leverage" class="!text-base">Long Leverage</x-form.label>
                <x-form.select id="new-account-long-leverage" name="newAccountForm.position_leverage_long" wire:model="newAccountForm.position_leverage_long" dimension="lg">
                    @foreach ($leverageOptions as $leverage)
                        <option value="{{ $leverage }}">{{ $leverage }}x</option>
                    @endforeach
                </x-form.select>
                @error('newAccountForm.position_leverage_long')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-short-leverage" class="!text-base">Short Leverage</x-form.label>
                <x-form.select id="new-account-short-leverage" name="newAccountForm.position_leverage_short" wire:model="newAccountForm.position_leverage_short" dimension="lg">
                    @foreach ($leverageOptions as $leverage)
                        <option value="{{ $leverage }}">{{ $leverage }}x</option>
                    @endforeach
                </x-form.select>
                @error('newAccountForm.position_leverage_short')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-long-margin" class="!text-base">Long Margin %</x-form.label>
                <x-form.input id="new-account-long-margin" name="newAccountForm.margin_percentage_long" wire:model="newAccountForm.margin_percentage_long" wire:blur="clearNewAccountAbsoluteMargin" dimension="lg" inputmode="decimal" placeholder="5.00" />
                <p class="mt-2 text-sm leading-5 text-zinc-500">Required when absolute margin is empty. Allowed range: 1.00% to 5.00%.</p>
                @error('newAccountForm.margin_percentage_long')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 md:col-span-6 lg:col-span-3">
                <x-form.label for="new-account-short-margin" class="!text-base">Short Margin %</x-form.label>
                <x-form.input id="new-account-short-margin" name="newAccountForm.margin_percentage_short" wire:model="newAccountForm.margin_percentage_short" wire:blur="clearNewAccountAbsoluteMargin" dimension="lg" inputmode="decimal" placeholder="5.00" />
                <p class="mt-2 text-sm leading-5 text-zinc-500">Required when absolute margin is empty. Allowed range: 1.00% to 5.00%.</p>
                @error('newAccountForm.margin_percentage_short')
                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-span-12 rounded-xl border border-zinc-500/15 bg-zinc-950/[0.02] p-4 dark:bg-white/[0.02]">
                <div class="mb-4 flex flex-col gap-1">
                    <div class="text-base font-semibold text-zinc-900 dark:text-zinc-100">Exchange credentials</div>
                    <p class="text-sm leading-5 text-zinc-500">
                        {{ $selectedApiSystem['name'] ?? 'Selected exchange' }} only shows the credential fields used by that exchange.
                    </p>
                </div>

                @if ($credentialFields === [])
                    <div class="rounded-lg border border-zinc-500/15 bg-zinc-500/10 px-4 py-3 text-base text-zinc-500">
                        No credential fields are configured for this exchange yet.
                    </div>
                @else
                    <div class="grid gap-4 {{ $credentialGridClass }}">
                        @foreach ($credentialFields as $credentialField)
                            <div data-credential-field="{{ $credentialField['field'] }}">
                                <x-form.label for="{{ $credentialField['id'] }}" class="!text-base">{{ $credentialField['label'] }}</x-form.label>
                                <x-form.input
                                    id="{{ $credentialField['id'] }}"
                                    name="newAccountForm.{{ $credentialField['field'] }}"
                                    wire:model="newAccountForm.{{ $credentialField['field'] }}"
                                    dimension="lg"
                                    autocomplete="off"
                                />
                                @if ($credentialField['field'] === 'api_passphrase')
                                    <p class="mt-2 text-sm leading-5 text-zinc-500">Required by KuCoin and BitGet account APIs.</p>
                                @endif
                                @error("newAccountForm.{$credentialField['field']}")
                                    <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="col-span-12 grid gap-3 md:grid-cols-2 xl:grid-cols-4">
                <div>
                    <x-form.checkbox id="new-account-active" name="newAccountForm.is_active" wire:model="newAccountForm.is_active" label="Active account" color="primary" />
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Makes this account available for Kraite operations.</p>
                </div>
                <div>
                    <x-form.checkbox id="new-account-trade" name="newAccountForm.can_trade" wire:model="newAccountForm.can_trade" label="Can trade" color="primary" />
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Allows Kraite to dispatch new positions for this account.</p>
                </div>
                <div>
                    <x-form.checkbox id="new-account-positions" name="newAccountForm.allow_other_positions" wire:model="newAccountForm.allow_other_positions" label="Allow other positions" color="primary" />
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Keeps manual exchange positions instead of closing unknown ones.</p>
                </div>
                <div>
                    <x-form.checkbox id="new-account-orders" name="newAccountForm.allow_other_orders" wire:model="newAccountForm.allow_other_orders" label="Allow other orders" color="primary" />
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Keeps manual exchange orders instead of cancelling unknown ones.</p>
                </div>
            </div>
        </div>

        <div class="mt-5 flex items-center justify-end gap-3 border-t border-zinc-500/15 pt-4">
            <div
                wire:loading.flex
                wire:target="saveNewAccount"
                class="items-center gap-2 text-base text-zinc-500"
            >
                <span class="size-4 animate-spin rounded-full border-2 border-primary-500/20 border-t-primary-500"></span>
                Creating
            </div>
            <x-button type="submit" variant="solid" color="primary" icon="FloppyDisk" dimension="lg" wire:loading.attr="disabled" wire:target="saveNewAccount">
                Create Account
            </x-button>
        </div>
    </form>
</div>
@endif
