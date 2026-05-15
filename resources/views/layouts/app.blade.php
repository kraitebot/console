<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="view-transition" content="same-origin" />
    <title>@yield('title', 'Kraite Console')</title>
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
</head>
<body x-data class="font-sans antialiased">

    @include('partials.aside-default')

    <x-wrapper>
        @yield('header')

        @hasSection('subheader')
            @yield('subheader')
        @endif

        @yield('content')
    </x-wrapper>

</body>
</html>
