<div data-component-name="AccountsIndex" class="flex flex-1 flex-col">
    @section('header-left')
        <x-breadcrumb
            :list="[['text' => 'Entities'], config('menu.entities.accounts')]"
            home-path="/dashboard"
        />
    @endsection

    @section('subheader')
        <x-subheader>
            <x-subheader.left>
                <div class="flex items-center gap-3 text-zinc-500">
                    <x-icon name="UserAccount" color="primary" size="text-2xl" />
                    <span>Accounts workspace</span>
                </div>
            </x-subheader.left>
        </x-subheader>
    @endsection

    <x-container>
        <div class="grid grid-cols-12 gap-4">
            <div class="col-span-12">
                <x-card>
                    <x-card.header>
                        <x-card.header-child>
                            <x-card.title>
                                <x-icon name="UserAccount" color="primary" size="text-3xl" />
                                <div>
                                    <div>Accounts</div>
                                    <x-card.subtitle>Stub page</x-card.subtitle>
                                </div>
                            </x-card.title>
                        </x-card.header-child>
                    </x-card.header>

                    <x-card.body class="min-h-96">
                        <div class="flex min-h-80 items-center justify-center overflow-hidden rounded-xl border border-dashed border-zinc-500/25 bg-zinc-100/50 px-6 py-10 text-center dark:bg-zinc-900/40">
                            <div class="max-w-md">
                                <div class="mx-auto mb-5 flex size-14 items-center justify-center rounded-xl bg-primary-500/15 text-primary-500">
                                    <x-icon name="UserAccount" size="text-3xl" />
                                </div>
                                <h2 class="text-xl font-semibold text-zinc-950 dark:text-zinc-100">Accounts will live here</h2>
                                <p class="mt-2 text-zinc-500">
                                    This placeholder gives the shell another Livewire destination while we tune content transitions.
                                </p>
                            </div>
                        </div>
                    </x-card.body>
                </x-card>
            </div>
        </div>
    </x-container>
</div>
