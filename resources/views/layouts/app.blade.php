<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ZHIB')</title>

    {{-- Global Header Styles --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
    <link rel="stylesheet" href="{{ asset('css/events.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hall-of-fame.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    {{-- Page Specific Styles --}}
    @stack('styles')
</head>

<body>

    {{-- Header / Navbar --}}
    @include('partials.header')

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- AUTH POPUP (GLOBAL, REUSABLE) --}}
    @guest
        @include('auth.login-form')
        @include('auth.register-form')
    @endguest

    {{-- Global Scripts --}}
    <script>
        // Global helper (future-safe)
        window.appConfig = {
            csrfToken: document.querySelector('meta[name="csrf-token"]').content
        };
    </script>

    {{-- Page Specific Scripts --}}
    @stack('scripts')

</body>
</html>
