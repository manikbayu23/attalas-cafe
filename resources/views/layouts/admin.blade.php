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
