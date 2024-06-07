<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="Ansonika">
    @include('layouts.partials.css')
    <!-- RemixIcon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css"
        integrity="sha512-MqL4+Io386IOPMKKyplKII0pVW5e+kb+PI/I3N87G3fHIfrgNNsRpzIXEi+0MQC0sR9xZNqZqCYVcC61fL5+Vg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield('title')</title>
</head>

<body>

    <div id="page">
        @include('layouts.partials.header')

        <main>
            @yield('main')
        </main>

        @include('layouts.partials.footer')
    </div>

    <div id="toTop"></div>

    @yield('components')

    <!-- COMMON SCRIPTS -->
    @include('layouts.partials.script')
    {{-- toastr --}}
    @include('layouts.components.toastr')
    <!-- SPECIFIC SCRIPTS -->
    @yield('javascript')
    {{-- auto clear session --}}
    {{ unsetSessions() }}



</body>

</html>