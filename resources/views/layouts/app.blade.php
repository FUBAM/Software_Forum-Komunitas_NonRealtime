<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'ZHIB')</title>

    {{-- Header styles --}}
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">

    {{-- Page styles --}}
    @yield('styles')

</head>

<body>

    {{-- Header partial --}}
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    {{-- Footer partial --}}
    @include('partials.footer')

    {{-- Page scripts --}}
    @yield('scripts')

</body>

</html>