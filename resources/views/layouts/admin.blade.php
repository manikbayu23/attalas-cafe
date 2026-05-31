<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('assets/images/attalas-logo.png') }}" type="image/png">

    <!-- Global stylesheets -->
    <link href="{{ asset('admin/assets/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/ltr/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">


    @stack('style')

    <style>
        .datepicker {
            z-index: 9999;
        }

        /* Attalas Cafe soft brown palette */
        :root {
            --attalas-brown-900: #2b160d;
            --attalas-brown-700: #5a3720;
            --attalas-brown-500: #8b5a2b;
            --attalas-brown-300: #b77b45;
            --attalas-cream-50: #f9f5f0;
        }

        body {
            background-color: var(--attalas-cream-50);
        }

        /* Sidebar: tetap gelap tapi lebih soft dan menyatu */
        .sidebar.sidebar-main {
            background: linear-gradient(155deg, var(--attalas-brown-900), var(--attalas-brown-700)) !important;
        }

        .nav-sidebar .nav-link {
            color: #e5d5c6;
        }

        .nav-sidebar .nav-link .ph {
            color: #f1e1d2;
        }

        .nav-sidebar .nav-link.active,
        .nav-sidebar .nav-link.active:hover {
            background-color: rgba(249, 245, 240, 0.12) !important;
            color: #ffffff !important;
        }

        .nav-sidebar .nav-link:hover {
            background-color: rgba(249, 245, 240, 0.06) !important;
            color: #ffffff !important;
        }

        /* Navbar: putih dengan aksen cokelat tipis, biar tidak terlalu berat */
        .navbar.navbar-light {
            background-color: #ffffff !important;
            border-bottom: 2px solid rgba(139, 90, 43, 0.12) !important;
        }

        /* Primary button: ambil tone login tapi sedikit lebih modern */
        .btn-primary,
        .btn.btn-primary {
            background-color: var(--attalas-brown-500) !important;
            border-color: var(--attalas-brown-500) !important;
        }

        .btn-primary:hover,
        .btn.btn-primary:hover {
            background-color: var(--attalas-brown-700) !important;
            border-color: var(--attalas-brown-700) !important;
        }

        .page-header-light {
            border-top: 3px solid rgba(139, 90, 43, 0.18) !important;
            background-image: linear-gradient(to right, rgba(139, 90, 43, 0.06), transparent);
        }
    </style>
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{ asset('admin/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- /core JS files -->

    <script src="{{ asset('admin/assets/js/app.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('admin/assets/js/vendor/notifications/noty.min.js') }}"></script>
    <script src="{{ asset('admin/assets/demo/pages/extra_noty.js') }}"></script>
    <!-- /theme JS files -->


    @stack('scripts')


</head>

<body>

    <!-- Page content -->
    <div class="page-content">

        @include('components.admin.sidebar')

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Inner content -->
            <div class="content-inner">

                @include('components.admin.navbar')


                @yield('content')

                @include('components.admin.footer')

            </div>
            <!-- /inner content -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</body>

</html>
