<div data-component-name="UserShow" class="flex flex-1 flex-col">
    <x-flash-toast :message="$flashToastMessage" />

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

    <x-subheader>
        <x-subheader.left>
            @foreach ($tabs as $tabName)
                @php
                    $isActive = $tab === $tabName;
                    $tabLabel = ucfirst($tabName);
                    $tabCount = $tabCounts[$tabName] ?? null;
                @endphp
                <x-button
                    wire:click="selectTab('{{ $tabName }}')"
                    :variant="$isActive ? 'soft' : 'link'"
                    :color="$isActive ? 'primary' : 'zinc'"
                    :aria-label="$tabCount === null ? $tabLabel : $tabLabel.' '.$tabCount"
                >
                    <span>{{ $tabLabel }}</span>
                    @if ($tabCount !== null)
                        <x-tabs.count-badge
                            :count="$tabCount"
                            :active="$isActive"
                        />
                    @endif
                </x-button>
            @endforeach
        </x-subheader.left>
        <x-subheader.right>
            <x-button href="{{ route('users.index') }}" wire:navigate variant="link" color="zinc" icon="ArrowLeft01">
                Back
            </x-button>
        </x-subheader.right>
    </x-subheader>

    <x-container>
        @if ($tab === 'details')
            <form wire:submit="save">
                <x-card>
                    <x-card.header>
                        <x-card.header-child>
                            @php
                                $colors = ['primary', 'secondary', 'blue', 'emerald', 'amber', 'violet', 'sky', 'lime', 'red'];
                                $avatarColor = $colors[crc32($user->email) % count($colors)];
                            @endphp
                            <x-avatar :src="$user->avatar" :name="$user->name" size="w-16" :color="$avatarColor" variant="soft" />
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
                                    <x-form.label for="avatar_image" class="!text-base">Avatar Image</x-form.label>
                                </div>
                                <div class="col-span-12 lg:col-span-9 xl:col-span-6">
                                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                                        @php
                                            $avatarPreview = $avatarImage ? $avatarImage->temporaryUrl() : ($avatar ?: null);
                                        @endphp
                                        <x-avatar :src="$avatarPreview" :name="$name" size="w-20" :color="$avatarColor" variant="soft" />
                                        <div class="flex-1">
                                            <x-form.file id="avatar_image" name="avatarImage" wire:model="avatarImage" accept="image/*" dimension="lg" />
                                            @if ($avatarPreview)
                                                <button
                                                    type="button"
                                                    wire:click="removeAvatar"
                                                    class="mt-3 inline-flex cursor-pointer items-center gap-2 rounded-lg border border-red-500/30 bg-red-500/10 px-3 py-2 text-base text-red-500 transition-colors duration-300 hover:bg-red-500/15"
                                                >
                                                    Remove avatar
                                                </button>
                                            @endif
                                            <div
                                                wire:loading.flex
                                                wire:target="avatarImage"
                                                class="mt-2 items-center gap-2 text-base text-zinc-500"
                                            >
                                                <span class="size-4 animate-spin rounded-full border-2 border-primary-500/20 border-t-primary-500"></span>
                                                Uploading preview
                                            </div>
                                        </div>
                                    </div>
                                    @error('avatarImage')
                                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-x-4">
                                <div class="col-span-12 pt-0 lg:col-span-3 lg:pt-4 xl:col-span-2">
                                    <x-form.label for="name" class="!text-base">Name</x-form.label>
                                </div>
                                <div class="col-span-12 lg:col-span-9 xl:col-span-6">
                                    <x-form.input id="name" name="name" wire:model="name" dimension="lg" placeholder="Name Surname" />
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-x-4">
                                <div class="col-span-12 pt-0 lg:col-span-3 lg:pt-4 xl:col-span-2">
                                    <x-form.label for="email" class="!text-base">Email</x-form.label>
                                </div>
                                <div class="col-span-12 lg:col-span-9 xl:col-span-6">
                                    <x-form.input id="email" type="email" name="email" wire:model="email" dimension="lg" placeholder="name@kraite.com" />
                                    @error('email')
                                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-x-4">
                                <div class="col-span-12 pt-0 lg:col-span-3 lg:pt-4 xl:col-span-2">
                                    <x-form.label for="status" class="!text-base">Status</x-form.label>
                                </div>
                                <div class="col-span-12 lg:col-span-9 xl:col-span-4">
                                    <x-form.select id="status" name="status" wire:model="status" dimension="lg">
                                        @foreach (['pending', 'confirmed', 'active', 'suspended'] as $opt)
                                            <option value="{{ $opt }}">{{ ucfirst($opt) }}</option>
                                        @endforeach
                                    </x-form.select>
                                    @error('status')
                                        <p class="mt-2 text-sm text-red-500/70">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-x-4">
                                <div class="col-span-12 pt-0 lg:col-span-3 lg:pt-4 xl:col-span-2">
                                    <x-form.label for="is_admin" class="!text-base">Role</x-form.label>
                                </div>
                                <div class="col-span-12 lg:col-span-9 xl:col-span-6">
                                    <x-form.checkbox id="is_admin" name="is_admin" value="1" wire:model="is_admin" label="Administrator" dimension="lg" />
                                    <x-form.description class="mt-2 !text-base">Admins can access the console and manage users.</x-form.description>
                                </div>
                            </div>

                            <div class="grid grid-cols-12 gap-x-4">
                                <div class="col-span-12 pt-0 lg:col-span-3 lg:pt-4 xl:col-span-2">
                                    <x-form.label class="!text-base">Created</x-form.label>
                                </div>
                                <div class="col-span-12 text-base text-zinc-500 lg:col-span-9 xl:col-span-6 lg:pt-4">
                                    {{ $user->created_at?->format('Y-m-d H:i') ?? '-' }}
                                    @if ($user->email_verified_at)
                                        - verified {{ $user->email_verified_at->format('Y-m-d H:i') }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </x-card.body>
                </x-card>

                <x-card class="sticky bottom-4 mt-4">
                    <x-card.footer>
                        <x-card.footer-child>
                            <span class="text-base text-zinc-500">
                                Last update: <strong class="font-bold text-zinc-900 dark:text-zinc-100">{{ $user->updated_at?->format('Y-m-d H:i') ?? '-' }}</strong>
                            </span>
                        </x-card.footer-child>
                        <x-card.footer-child>
                            <x-button href="{{ route('users.index') }}" wire:navigate variant="outline" color="zinc" aria-label="Cancel">
                                Cancel
                            </x-button>
                            <button
                                type="submit"
                                wire:loading.attr="disabled"
                                wire:target="save"
                                class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-lg border border-primary-500 bg-primary-500 px-5 py-2 text-lg text-zinc-800 transition-all duration-300 ease-in-out hover:border-primary-600 hover:bg-primary-600 disabled:opacity-50"
                                aria-label="Save"
                            >
                                <x-icon name="FloppyDisk" />
                                <span wire:loading.remove wire:target="save">Save</span>
                                <span wire:loading wire:target="save">Saving...</span>
                            </button>
                        </x-card.footer-child>
                    </x-card.footer>
                </x-card>
            </form>
        @endif

        @if ($tab === 'accounts')
            <x-lazy-tab-content
                target="selectTab"
                title="Loading accounts"
                message="Fetching linked exchange accounts..."
            >
                <x-users.accounts.panel
                    :accounts="$accounts"
                    :forms="$accountForms"
                    :expanded="$expandedAccounts"
                    :connectivity="$accountConnectivity"
                    :quote-options="$accountQuoteOptions"
                    :leverage-options="$leverageOptions"
                    :is-creating="$isCreatingAccount"
                    :new-form="$newAccountForm"
                    :api-system-options="$accountApiSystemOptions"
                    :trade-configuration-options="$tradeConfigurationOptions"
                    :new-quote-options="$newAccountQuoteOptions"
                />
            </x-lazy-tab-content>
        @endif

        @if ($tab === 'positions')
            <x-lazy-tab-content
                target="selectTab"
                title="Loading positions"
                message="Reconciling user positions..."
            >
                <x-users.positions.panel
                    :accounts="$positionAccounts"
                    :selected-account-id="$selectedPositionAccountId"
                    :data="$positionData"
                    :history="$positionHistory"
                    :history-page="$positionHistoryPage"
                    :history-last-page="$positionHistoryLastPage"
                    :history-total="$positionHistoryTotal"
                    :only-drifts="$onlyPositionDrifts"
                    :expanded-pairs="$expandedPositionPairs"
                    :expanded-history="$expandedPositionHistory"
                />
            </x-lazy-tab-content>
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
</div>
