@extends('layouts.app')

@section('header')
    <x-header>
        <x-header.left>
            @yield('header-left')
        </x-header.left>
        <x-header.right>
            <button
                type="button"
                aria-label="Theme"
                class="text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100"
                @click="$store.theme.cycle()"
            >
                @foreach (['light' => 'Sun03', 'dark' => 'Moon02', 'system' => 'Computer'] as $mode => $icon)
                    <span class="inline-flex text-2xl leading-none" x-show="$store.theme.mode === '{{ $mode }}'">
                        @include('icons.' . $icon)
                    </span>
                @endforeach
            </button>
            <button type="button" aria-label="Language" class="text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100">
                <span class="inline-flex text-2xl leading-none">@include('icons.LanguageSquare')</span>
            </button>
            <button type="button" aria-label="Notifications" class="text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100">
                <span class="inline-flex text-2xl leading-none">@include('icons.Notification03')</span>
            </button>
        </x-header.right>
    </x-header>
@endsection
