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

        /* Attalas Cafe Public Palette (Dark/Sage) */
        :root {
            --primary-950: #111d1c;
            --primary-900: #203231;
            --primary-800: #2d4442;
            --primary-700: #3c5956;
            --primary-100: #dce7e3;
            --mist-50: #f5f7f4;
        }

        body {
            background-color: var(--mist-50);
        }

        /* Sidebar: dark, blending with the theme */
        .sidebar.sidebar-main {
            background: linear-gradient(155deg, var(--primary-950), var(--primary-800)) !important;
        }

        .nav-sidebar .nav-link {
            color: #dce7e3;
        }

        .nav-sidebar .nav-link .ph {
            color: #dce7e3;
        }

        .nav-sidebar .nav-link.active,
        .nav-sidebar .nav-link.active:hover {
            background-color: rgba(220, 231, 227, 0.12) !important;
            color: #ffffff !important;
        }

        .nav-sidebar .nav-link:hover {
            background-color: rgba(220, 231, 227, 0.06) !important;
            color: #ffffff !important;
        }

        /* Navbar: clean with a subtle border */
        .navbar.navbar-light {
            background-color: #ffffff !important;
            border-bottom: 2px solid rgba(60, 89, 86, 0.12) !important;
        }

        /* Primary button */
        .btn-primary,
        .btn.btn-primary {
            background-color: var(--primary-900) !important;
            border-color: var(--primary-900) !important;
        }

        .btn-primary:hover,
        .btn.btn-primary:hover {
            background-color: var(--primary-800) !important;
            border-color: var(--primary-800) !important;
        }

        .page-header-light {
            border-top: 3px solid rgba(60, 89, 86, 0.18) !important;
            background-image: linear-gradient(to right, rgba(60, 89, 86, 0.06), transparent);
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Noty.overrideDefaults({
                theme: 'limitless',
                layout: 'topRight',
                type: 'alert',
                timeout: 3000
            });

            @if(session('success'))
                new Noty({
                    text: '{{ session('success') }}',
                    type: 'success'
                }).show();
            @endif

            @if(session('error'))
                new Noty({
                    text: '{{ session('error') }}',
                    type: 'error'
                }).show();
            @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    new Noty({
                        text: '{{ $error }}',
                        type: 'error'
                    }).show();
                @endforeach
            @endif
        });
    </script>


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
