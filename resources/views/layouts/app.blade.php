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
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group" style="margin-top: 40px;">
                    <div class="list-group-item text-center">
                        <h4 class="list-group-item-heading">Username</h4>
                        <p class="list-group-item-text"><span class="text-danger">roles</span></p>
                    </div>
                    <a href="#" class="list-group-item"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    <a href="/user" class="list-group-item"><i class="fa fa-fw fa-users"></i> Manage Users</a>
                </div>
            </div>

            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>

    @section('script')

    <script src="/vendor/jquery/jquery-1.11.3.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    @show
</body>
</html>
