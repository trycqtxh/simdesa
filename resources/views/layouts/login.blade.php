<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}| Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    {{ Html::style('assets/bootstrap/css/bootstrap.min.css') }}
    <!-- Font Awesome -->
    {{ Html::style('assets/bower_components/components-font-awesome/css/font-awesome.min.css') }}
    <!-- Ionicons -->
    {{ Html::style('assets/bower_components/Ionicons/css/ionicons.min.css') }}
    <!-- Theme style -->
    {{ Html::style('assets/dist/css/AdminLTE.min.css') }}
    <!-- iCheck -->
    {{ Html::style('assets/plugins/iCheck/square/blue.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .login-page {
            background-image: url('img/bg/bg2.jpg');
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            height: 100%;
        }
        .login-box{
            margin: 12% 50px;
            float: right;
        }
        .app-title {
            width: auto;
            float: left;
            margin: 15% 20px 5px 100px;
            font-size: 38px;
            color: #deff42;
            font-weight: 800;
            font-family: "Stencil";
            text-shadow: 0px 6px 6px rgba(32, 75, 30, 0.69);
        }
    </style>
</head>
<body class="hold-transition login-page">
<h1 class="app-title">{{ strtoupper(config('app.name')) }}</h1>
<div class="login-box">
    {{--<div class="login-logo">--}}
        {{--<a href="">{{ config('app.alias') }}</a>--}}
    {{--</div>--}}
    <!-- /.login-logo -->
    <div class="login-box-body">
        {{--<p class="login-box-msg">Sign in to start your session</p>--}}

        <form action="{{ route('login.post') }}" method="POST">
            @if($errors->has('message'))
                <div class="alert alert-danger">
                    {{$errors->first('message')}}
                </div>
            @endif

            <div class="form-group has-feedback {{ $errors->has('nip') ? 'has-error' : '' }}">
                {{ csrf_field() }}
                <input class="form-control" placeholder="NIP / NIAP" name="nip" value="{{ old('nip') }}">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                @if ($errors->has('nip'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nip') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="row">
                <div class="col-xs-8">
                    {{--<div class="checkbox icheck">--}}
                        {{--<label>--}}
                            {{--<input type="checkbox" name="remember"> Remember Me--}}
                        {{--</label>--}}
                    {{--</div>--}}
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.0 -->
{{ Html::script('assets/plugins/jQuery/jquery-2.2.3.min.js') }}
<!-- Bootstrap 3.3.5 -->
{{ Html::script('assets/bootstrap/js/bootstrap.min.js') }}
<!-- iCheck -->
{{ Html::script('assets/plugins/iCheck/icheck.min.js') }}
{{--<script>--}}
    {{--$(function () {--}}
        {{--$('input').iCheck({--}}
            {{--checkboxClass: 'icheckbox_square-blue',--}}
            {{--radioClass: 'iradio_square-blue',--}}
            {{--increaseArea: '20%' // optional--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}
</body>
</html>
