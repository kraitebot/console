@extends('layouts.admin')

@section('title', 'New User — Kraite Console')

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
            <span class="text-sm text-zinc-500">Create a new user</span>
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
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
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
                                <x-form.label for="name">Name</x-form.label>
                            </div>
                            <div class="col-span-12 lg:col-span-9 xl:col-span-6">
                                <x-form.input
                                    id="name"
                                    name="name"
                                    :value="old('name')"
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
                                    :value="old('email')"
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
                                    x-data="{ open: false, status: '{{ old('status', 'pending') }}' }"
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
                                    :checked="(bool) old('is_admin')"
                                    label="Administrator"
                                />
                                <x-form.description class="mt-2">Admins can access the console and manage users.</x-form.description>
                            </div>
                        </div>
                    </div>
                </x-card.body>

                <x-card.footer>
                    <x-card.footer-child>
                        <span class="text-sm text-zinc-500">A random password is generated. Send a reset link to onboard.</span>
                    </x-card.footer-child>
                    <x-card.footer-child>
                        <x-button href="{{ route('users.index') }}" variant="outline" color="zinc" aria-label="Cancel">
                            Cancel
                        </x-button>
                        <x-button type="submit" variant="solid" color="primary" icon="UserAdd02" aria-label="Add User">
                            Add User
                        </x-button>
                    </x-card.footer-child>
                </x-card.footer>
            </x-card>
        </form>
    </x-container>
@endsection
