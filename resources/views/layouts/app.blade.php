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

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700">

    @show
</head>
<body>
    @yield('content')

    @section('script')

    <script src="/vendor/jquery/jquery-1.11.3.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    @show
</body>
</html>
