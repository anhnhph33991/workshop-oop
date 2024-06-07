<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.partials.css')
    <title>@yield('title', 'Admin')</title>
</head>

<body>

    <div class="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('layouts.partials.header')
            @include('layouts.partials.nav')
            <div class="main-content">
                @yield('main')
            </div>
            @include('layouts.partials.footer')
        </div>
    </div>


    @include('layouts.partials.script')
    @yield('javascript')

    {{-- auto clear sessions --}}
    {{ unsetSessions() }}

</body>

</html>