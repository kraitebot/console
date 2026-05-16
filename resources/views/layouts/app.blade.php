<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="view-transition" content="same-origin" />
    <title>@yield('title', 'Kraite Console')</title>
    @include('partials.favicon')
    <script>
        (function () {
            const mode = localStorage.getItem('theme') || 'system';
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = mode === 'dark' || (mode === 'system' && prefersDark);
            document.documentElement.classList.toggle('dark', isDark);
            document.documentElement.style.colorScheme = isDark ? 'dark' : 'light';
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body x-data x-init="$store.theme.init()" class="font-sans antialiased">

    <div data-component-name="AsidePersist" class="peer contents">
        @persist('app-aside')
            @include('partials.aside-default')
        @endpersist
    </div>

    <x-wrapper>
        @yield('header')

        <x-page-transition>
            @hasSection('subheader')
                @yield('subheader')
            @endif

            @yield('content')
        </x-page-transition>
    </x-wrapper>

    <x-toast-container />

    @livewireScripts
</body>
</html>
