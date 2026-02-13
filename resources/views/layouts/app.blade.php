<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Startup Dashboard</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:title" content="" />
        <meta property="og:type" content="" />
        <meta property="og:url" content="" />
        <meta property="og:image" content="" />
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('backend/assets/imgs/theme/favicon.png') }}" />
        <!-- Template CSS -->
        <link href="{{ asset('backend/assets/css/main.css?v=1.1') }}" rel="stylesheet" type="text/css" />
    </head>

    <body>
        @auth
        <div class="screen-overlay"></div>
        @include('layouts.siderbar')
        <main class="main-wrap">
            @include('layouts.header')
            @endauth
            @yield('admin_content')
            @auth
            <!-- content-main end// -->
        @include('layouts.footer')
        @endauth
        </main>
        <script src="{{ asset('backend/assets/js/vendors/jquery-3.6.0.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/vendors/select2.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/vendors/perfect-scrollbar.js')}}"></script>
        <script src="{{ asset('backend/assets/js/vendors/jquery.fullscreen.min.js')}}"></script>
        <script src="{{ asset('backend/assets/js/vendors/chart.js')}}"></script>
        <!-- Main Script -->
        <script src="{{ asset('backend/assets/js/main.js?v=1.1')}}" type="text/javascript"></script>
        <script src="{{ asset('backend/assets/js/custom-chart.js')}}" type="text/javascript"></script>
    </body>
</html>
