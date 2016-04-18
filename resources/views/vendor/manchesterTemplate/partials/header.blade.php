<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @yield('meta')

    <title>{{ $title or 'Carriage Hubs' }}</title>


    @yield('css_top')

    <!-- Bootstrap core CSS -->
    <link href="{{ URL::to('vendor/manchesterTemplate/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ URL::to('vendor/manchesterTemplate/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendor/manchesterTemplate/css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{ URL::to('vendor/manchesterTemplate/css/custom.css') }}" rel="stylesheet">
    <link href="{{ URL::to('vendor/manchesterTemplate/css/icheck/flat/green.css') }}" rel="stylesheet">

    @yield('css_bottom')

    <script src="{{ URL::to('vendor/manchesterTemplate/js/jquery.min.js') }}"></script>

    <link href="{{ URL::to('vendor/manchesterTemplate/css/datatables/tools/css/dataTables.tableTools.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{ URL::to('vendor/manchesterTemplate/js/ie8-responsive-file-warning.js') }}"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield('js_header')

</head>