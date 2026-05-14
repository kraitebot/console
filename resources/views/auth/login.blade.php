@extends('layouts.guest')

@section('title', 'Sign in — Kraite Console')

@section('content')
    <div class="mx-auto w-full max-w-md p-6">
        <x-card class="dark:bg-zinc-900!">
            <x-card.body class="p-8!">
                <a href="/" aria-label="Kraite" class="mb-8 flex w-full items-center justify-center">
                    <img src="/brand/snake-green.svg" alt="Kraite" class="h-20" />
                </a>

                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-zinc-800 dark:text-white">Sign in</h1>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                        Operator access. Admin accounts only.
                    </p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="mt-5">
                    @csrf

                    <div class="grid gap-y-4">
                        <div>
                            <x-form.label for="email">Email</x-form.label>
                            <x-form.validation field="email">
                                <x-form.input
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="username"
                                    :value="old('email')"
                                    placeholder="you@kraite.com"
                                    required
                                    autofocus
                                />
                            </x-form.validation>
                        </div>

                        <div>
                            <x-form.label for="password">Password</x-form.label>
                            <x-form.validation field="password">
                                <x-form.input
                                    id="password"
                                    name="password"
                                    type="password"
                                    autocomplete="current-password"
                                    placeholder="Enter password"
                                    required
                                />
                            </x-form.validation>
                        </div>

                        <x-form.checkbox
                            id="remember"
                            name="remember"
                            label="Remember me"
                            color="emerald"
                            dimension="sm"
                            :checked="old('remember')"
                        />

                        <x-button type="submit" variant="solid" color="primary" class="py-2.5! font-bold">
                            Sign in
                        </x-button>
                    </div>
                </form>
            </x-card.body>
        </x-card>
    </div>
@endsection
