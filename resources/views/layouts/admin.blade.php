<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="py-2 bg-primary">
            <div class="container">
                <div class="d-flex align-items-center">
                    <div class="brand">
                        <img class="img-fluid h-100" src="{{asset('assets/img/logo.png')}}" />
                    </div>
                    <div class="page-title d-flex justify-content-center align-items-center text-center">
                        <h3 class="m-0 text-white fw-bold">POST UTME MOCK EXAM</h3>
                    </div>
                    <div class="justify-items-end">
                        <small> <a href="/admin/">Go Home</a></small>
                    </div>
                </div>
            </div>
        </header>
    
        <main >
            @yield('content')
        </main>

        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary footer">
            <!-- Copyright -->
            <div class="text-white mb-3 mb-md-0">
            Copyright © 2020 Logic Software Solutions. All rights reserved.
            </div>
            <!-- Copyright -->

            <!-- Right -->
            <div>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#!" class="text-white me-4">
                <i class="fab fa-google"></i>
            </a>
            <a href="#!" class="text-white">
                <i class="fab fa-linkedin-in"></i>
            </a>
            </div>
            <!-- Right -->
        </div>
    </div>
    @yield("script")
</body>
</html>
