<div data-component-name="UserCreate" class="flex flex-1 flex-col">
    @section('header-left')
        <x-breadcrumb
            :list="[
                ['text' => 'Entities'],
                array_merge(config('menu.entities.users'), ['to' => route('users.index')]),
                ['text' => 'New'],
            ]"
            home-path="/dashboard"
        />
    @endsection

    @section('subheader')
        <x-subheader>
            <x-subheader.left>
                <span class="text-base text-zinc-500">Create a new user</span>
            </x-subheader.left>
            <x-subheader.right>
                <x-button href="{{ route('users.index') }}" wire:navigate variant="link" color="zinc" icon="ArrowLeft01">
                    Back
                </x-button>
            </x-subheader.right>
        </x-subheader>
    @endsection

    <x-container>
        <form wire:submit="save">
            <x-card>
                <x-card.header>
                    <x-card.header-child>
                        <x-card.title>
                            <x-icon name="UserAdd02" color="primary" size="text-3xl" />
                            <div>
                                <div>New User</div>
                                <x-card.subtitle>Add an operator or trader account</x-card.subtitle>
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
                                        $avatarPreview = $avatarImage ? $avatarImage->temporaryUrl() : null;
                                        $colors = ['primary', 'secondary', 'blue', 'emerald', 'amber', 'violet', 'sky', 'lime', 'red'];
                                        $avatarColor = $email ? $colors[crc32($email) % count($colors)] : 'primary';
                                    @endphp
                                    <x-avatar :src="$avatarPreview" :name="$name ?: 'New User'" size="w-20" :color="$avatarColor" variant="soft" />
                                    <div class="flex-1">
                                        <x-form.file id="avatar_image" name="avatarImage" wire:model="avatarImage" accept="image/*" dimension="lg" />
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
                                <x-form.label for="is_admin" class="!text-base">Role</x-form.label>
                            </div>
                            <div class="col-span-12 lg:col-span-9 xl:col-span-6">
                                <x-form.checkbox id="is_admin" name="is_admin" value="1" wire:model="is_admin" label="Administrator" dimension="lg" />
                                <x-form.description class="mt-2 !text-base">Admins can access the console and manage users.</x-form.description>
                            </div>
                        </div>
                    </div>
                </x-card.body>

                <x-card.footer>
                    <x-card.footer-child>
                        <span class="text-base text-zinc-500">A random password is generated. Send a reset link to onboard.</span>
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
                            aria-label="Add User"
                        >
                            <x-icon name="UserAdd02" />
                            <span wire:loading.remove wire:target="save">Add User</span>
                            <span wire:loading wire:target="save">Saving...</span>
                        </button>
                    </x-card.footer-child>
                </x-card.footer>
            </x-card>
        </form>
    </x-container>
</div>
