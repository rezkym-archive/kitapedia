<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

        <title> @yield('title_head') - {{ env('APP_NAME') }} </title>

        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

        <!-- CSS Libraries -->
        @stack('css_lib')

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}"> 

        {{-- Google Analytics --}} 
        @include('layouts.g_analytics')

    </head>

    <body class="dark-mode">
        <div  id="app">
            <div class="main-wrapper main-wrapper-1 ">
                <div class="navbar-bg "></div>
                
                <!--======================================
                    =========== Start Top Bar ============
                    ======================================
                -->
                
                @if (auth()->check())
                    @include('layouts.topbar')
                @endif
                
                <!--======================================
                    =========== Start Top Bar ============
                    ======================================
                -->
                
                <!--======================================
                    =========== Start Side Bar ===========
                    ======================================
                -->
                @if (auth()->check())
                    @include('layouts.sidebar')
                    @endif
                <!--======================================
                    =========== End Side Bar =============
                    ======================================
                -->

                <!--======================================
                    =========== Start Content ============
                    ======================================
                -->
                @if (auth()->check())
                    @yield('content')
                @endif
                <!--======================================
                    =========== End Content ==============
                    ======================================
                -->


                <!--======================================
                    =========== Start Footer =============
                    ======================================
                -->
                @if (auth()->check())
                    @include('layouts.footer')
                @endif
                <!--======================================
                    =========== End Footer ===============
                    ======================================
                -->
            </div>
        </div>

        <!-- General JS Scripts -->
        <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/modules/popper.js') }}"></script>
        <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
        <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
        <script src="{{ asset('assets/js/stisla.js') }}"></script>

        <!-- JS Libraies -->
        @stack('js_lib')

        <!-- Page Specific JS File -->
        @stack('js_specific')

        <!-- Javascript in HTML Code -->
        @stack('js_html')

        <!-- Template JS File -->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>
        <script src="{{ asset('assets/js/custom.js') }}"></script>
    </body>

</html>