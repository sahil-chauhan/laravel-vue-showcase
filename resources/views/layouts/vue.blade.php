<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">

        <!-- Bootstrap Css -->
        <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ URL::asset('/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ URL::asset('/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

        <!-- Styles -->
        {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

        <script>
            window.Laravel = <?php echo json_encode([
                'asset_url' => URL::asset('/'),
                'GITHUB_CLIENT_ID' => config('services.github.client_id'),
                'GITHUB_CLIENT_CALLBACK_URL' => config('services.github.redirect'),
                'LINKEDIN_CLIENT_ID' => config('services.linkedin.client_id'),
                'LINKEDIN_CLIENT_CALLBACK_URL' => config('services.linkedin.redirect'),
            ]); ?>
        </script>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

    </head>

    <body data-sidebar="dark">
        <div id="app">
            @yield('content')
        </div>
     
        <script src="{{ URL::asset('assets/libs/jquery/jquery.min.js')}}"></script>
        {{-- <script src="{{ URL::asset('assets/libs/bootstrap/js/bootstrap.min.js')}}"></script> --}}
        <script src="{{ URL::asset('assets/libs/metismenu/metismenu.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ URL::asset('assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="{{ URL::asset('assets/js/app.js')}}"></script>

    </body>
</html>