<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - Sistem Informasi Perjalanan Dinas</title>

    @section('stylesheet')
    <link rel="stylesheet" href="/css/all.css">
    <link rel="stylesheet" href="/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/adminLTE/css/adminLTE.css">
    <link rel="stylesheet" href="/vendor/adminLTE/css/skins/skin-black.css">
    <link rel="stylesheet" href="/style.css">

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700">

    @show
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('images/login-logo.png') }}" alt="Logo">
            <p>Aplikasi Sistem Informasi Perjalanan Dinas</p>
        </div>
        <div class="login-box-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <i class="fa fa-fw fa-exclamation"></i> {{ $error }}
                        <br>
                    @endforeach
                </div>
            @endif
            {!! Form::open(['method' => 'POST', 'route' => 'user.login']) !!}
                <div class="form-group has-feedback">
                    {!! Form::label('email', 'E-mail') !!}
                    {!! Form::input('email', 'email', null, ['placeholder' => 'name@domain.com', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group has-feedback">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::input('password', 'password', null, ['placeholder' => 'password', 'class' => 'form-control']) !!}
                </div>
                <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-fw fa-sign-in"></i> Login</button>
            {!! Form::close() !!}

        </div>
    </div>

</body>
</html>
