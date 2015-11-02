<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title or trans('manchesterTemplate::login.login') }}</title>

    <!-- Bootstrap core CSS -->

    <link href="{{ URL::to('vendor/manchesterTemplate/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ URL::to('vendor/manchesterTemplate/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendor/manchesterTemplate/css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ URL::to('vendor/manchesterTemplate/css/custom.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendor/manchesterTemplate/css/icheck/flat/green.css') }}" rel="stylesheet">


    <script src="{{ URL::to('vendor/manchesterTemplate/js/jquery.min.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="{{ URL::to('vendor/manchesterTemplate/js/ie8-responsive-file-warning.js') }}"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body style="background:#F7F7F7;">

<div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
        <div id="login" class="animate form">
            <section class="login_content">
                {!! Form::open(['url'=>$login, 'method'=>'post']) !!}
                <h1>Login Form</h1>
                <div>
                    {!! Form::text('username', null,['required' => 'true', 'placeholder' => 'Username', 'class' => 'form-control']) !!}
                </div>
                <div>
                    {!! Form::password('password', ['required' => 'true', 'placeholder' => 'Password', 'class' => 'form-control']) !!}
                </div>
                <div>
                    {!! Form::submit('Login', ['class' => 'btn btn-default submit']) !!}
                </div>
                <div class="clearfix"></div>
                <div class="separator">

                    <p class="change_link">New to site?
                        <a href="#toregister" class="to_register"> Create Account </a>
                    </p>
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h1><img src="{{ URL::to('vendor/manchesterTemplate/images/manchester/copyright.png') }}"/> Chemistry, University of Manchester</h1>

                        <p>©2015 All Rights Reserved. Electronics Section, Chemistry, The University of Manchester.</p>
                    </div>
                </div>
                {!! Form::close() !!}
            </section>
            <!-- content -->
        </div>
        <div id="register" class="animate form">
            <section class="login_content">
                <h1>Create Account</h1>

                <p>
                    You do not need to create an account, just use your university username and password.
                </p>
                <p class="change_link">
                    <a href="#tologin" class="to_register"> Log in </a>
                </p>
            </section>
            <!-- content -->
        </div>
    </div>
</div>

</body>

</html>