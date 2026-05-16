@props([
    'accounts' => [],
    'forms' => [],
    'expanded' => [],
    'connectivity' => [],
    'quoteOptions' => [],
    'leverageOptions' => [],
    'isCreating' => false,
    'newForm' => [],
    'apiSystemOptions' => [],
    'tradeConfigurationOptions' => [],
    'newQuoteOptions' => [],
])

<div data-component-name="Users/AccountsPanel">
    <x-card>
        <x-card.header>
            <x-card.header-child>
                <x-card.title>
                    <x-icon name="UserAccount" color="primary" size="text-3xl" />
                    <div>
                        <div>Accounts</div>
                        <x-card.subtitle>{{ count($accounts) }} linked {{ str('account')->plural(count($accounts)) }}</x-card.subtitle>
                    </div>
                </x-card.title>
            </x-card.header-child>
            <x-card.header-child>
                <x-button
                    type="button"
                    variant="solid"
                    color="primary"
                    icon="PlusSignCircle"
                    dimension="lg"
                    wire:click="showCreateAccountForm"
                    wire:loading.attr="disabled"
                    wire:target="showCreateAccountForm"
                >
                    Create account
                </x-button>
            </x-card.header-child>
        </x-card.header>

        <x-card.body>
            <x-users.accounts.create-form
                :is-open="$isCreating"
                :form="$newForm"
                :api-system-options="$apiSystemOptions"
                :trade-configuration-options="$tradeConfigurationOptions"
                :quote-options="$newQuoteOptions"
                :leverage-options="$leverageOptions"
            />

            @if (empty($accounts))
                <div class="rounded-xl border border-dashed border-primary-500/25 bg-primary-500/5 px-5 py-6 text-center">
                    <div class="mx-auto flex size-12 items-center justify-center rounded-lg border border-primary-500/25 bg-primary-500/10 text-primary-500">
                        <x-icon name="UserAccount" size="text-2xl" />
                    </div>
                    <div class="mt-3 text-lg font-semibold text-zinc-900 dark:text-zinc-100">No linked accounts</div>
                    <p class="mt-1 text-base text-zinc-500">Create the first exchange account for this user.</p>
                </div>
            @else
                <div class="flex flex-col gap-3">
                    @foreach ($accounts as $account)
                        <x-users.accounts.row
                        :account="$account"
                        :form="$forms[$account['id']] ?? []"
                        :expanded="$expanded[$account['id']] ?? false"
                        :connectivity="$connectivity[$account['id']] ?? null"
                        :quote-options="$quoteOptions[$account['id']] ?? []"
                        :leverage-options="$leverageOptions"
                    />
                    @endforeach
                </div>
            @endif
        </x-card.body>
    </x-card>
</div>
