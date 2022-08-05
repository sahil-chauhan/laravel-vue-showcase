<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">

        @include('layouts.head-css')

    </head>

    <body>
        <div class="account-pages my-5 pt-sm-5">
            @yield('content')
        </div>
        <!-- end account-pages -->

        @include('layouts.footer-js')
    </body>
</html>
