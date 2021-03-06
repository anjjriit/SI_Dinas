<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page_title') - Sistem Informasi Perjalanan Dinas</title>

    @section('stylesheet')
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/adminLTE/css/AdminLTE.css">
    <link rel="stylesheet" href="/vendor/adminLTE/css/skins/skin-black.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,500">
    @show
    <link rel="stylesheet" href="/style.css">
</head>
<body class="skin-black sidebar-mini">
    <div class="wrapper">
        @include('partials.navbar')

        @include('partials.sidebar')

        <div class="content-wrapper" style="min-height: 100%;">
            @yield('content')
        </div>

        <div class="main-footer">
            &copy; {{ date('Y') }} Javan Cipta Solusi.
        </div>
    </div>

    @section('script')

    <script src="/vendor/jquery/jquery-1.11.3.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="/vendor/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="/vendor/adminLTE/js/app.js"></script>
    @show
</body>
</html>
