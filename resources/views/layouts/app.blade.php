<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Kraite Console')</title>
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
