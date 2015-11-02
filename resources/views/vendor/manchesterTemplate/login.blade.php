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
                    {!! Form::text('email', null,['required' => 'true', 'placeholder' => 'Username', 'class' => 'form-control']) !!}
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
                        <h1>
                            @if(config('admintemplate.copyright_logo')) <img src="{{ URL::to(config('admintemplate.copyright_logo')) }}"/>@endif {{ config('admintemplate.copyright_string_short') }}</h1>
                        <p>{{ config('admintemplate.copyright_string') }}</p>
                    </div>
                </div>
                {!! Form::close() !!}
            </section>
            <!-- content -->
        </div>
        <div id="register" class="animate form">
            <section class="login_content">
                <h1>Create Account</h1>

                @if(config('admintemplate.show_registration_form'))
                    {!! Form::open(['url'=>$registration, 'method'=>'post']) !!}
                    <div>
                        {!! Form::text('name', null,['required' => 'true', 'placeholder' => 'Username', 'class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!! Form::text('email', null,['required' => 'true', 'placeholder' => 'Email address', 'class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!! Form::password('password', ['required' => 'true', 'placeholder' => 'Password', 'class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!! Form::password('password_confirmation', ['required' => 'true', 'placeholder' => 'Password Confirmed', 'class' => 'form-control']) !!}
                    </div>
                    <div>
                        {!! Form::submit('Register', ['class' => 'btn btn-default submit']) !!}
                    </div>
                    {!! Form::close() !!}
                @else
                    <p>
                        {{ config('admintemplate.show_registration_message') }}
                    </p>
                    <p class="change_link">
                        <a href="#tologin" class="to_register"> Log in </a>
                    </p>
                @endif
                <div class="clearfix"></div>
                <div class="separator">
                    <div class="clearfix"></div>
                    <br />
                    <div>
                        <h1>@if(config('admintemplate.copyright_logo')) <img src="{{ URL::to(config('admintemplate.copyright_logo')) }}"/>@endif {{ config('admintemplate.copyright_string_short') }}</h1>

                        <p>{{ config('admintemplate.copyright_string') }}</p>
                    </div>
                </div>
            </section>
            <!-- content -->
        </div>
    </div>
</div>

</body>

</html>