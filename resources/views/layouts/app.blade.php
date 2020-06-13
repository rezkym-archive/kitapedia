<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

        <title> @yield('title_head') - {{ env('APP_NAME') }} </title>

        <!-- General CSS Files -->
        <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        

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
                    =========== Start Side Bar ===========
                    ======================================
                -->
                @if (auth()->check())
                    @include('layouts.sidebar')
                @endif

                <!--======================================
                    =========== Start Content ============
                    ======================================
                -->
                @if (auth()->check())
                    @yield('content')
                @endif


                <!--======================================
                    ======== Start Modal Content =========
                    ======================================
                -->
                @if (auth()->check())
                    @yield('modal')
                @endif

                <!--======================================
                    =========== Start Footer =============
                    ======================================
                -->
                @if (auth()->check())
                    @include('layouts.footer')
                @endif


            </div>
        </div>
        

        <!-- General JS Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <script src="{{ asset('assets/modules/popper.js') }}"></script>
        <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
        
        <script src="{{ asset('assets/js/stisla.js') }}"></script>

        <!-- Custom javascript in html -->
        <script type="text/javascript">
            /* ToolTip Function */
            $('[data-toggle="tooltip"]').tooltip();
        </script>

        <!-- Template JS File -->
        <script src="{{ asset('assets/js/scripts.js') }}"></script>

        <!-- JS Libraies -->
        @stack('js_lib')

        <!-- Page Specific JS File -->
        @stack('js_specific')

        <!-- Javascript in HTML Code -->
        @stack('js_html')

        
    </body>

</html>