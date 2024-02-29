<!doctype html>
<html lang="en">
  <head>
    <!-- HTML5 Shim and Respond.js IE10 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Meta -->
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <meta name="description" content="Mirco ERP"/>
    <meta name="keywords" content="tdp">
    <meta name="author" content="tdp" />

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ url('/assets/bootstrap-5.2.2-dist/css/bootstrap.css?v=') . time() }}">
    <!-- Font Awesome css -->
    <link rel="stylesheet" href="{{ url('/assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
    @yield('javarel')

    <link href="/assets/js/jquery-ui-1.10.3/themes/base/jquery-ui.css" rel="stylesheet">
    <link href="{{ url('/assets/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css') }}" type="text/css" rel="stylesheet" />
    <link href="/assets/css/jquery.alerts.css" rel="stylesheet">

    
    <script src="{{ url('/assets/js/jQuery-3.3.1.js') }}"></script>
    <script src="{{ url('/assets/js/jquery-migrate-1.1.1.min.js') }}"></script>

    <!-- <script src="{{ url('/assets/js/jquery-1.11.1.js') }}"></script>
    <script src="/assets/js/jquery-migrate-1.1.1.min.js"></script> -->

    <title>{{ $title }}</title>

    <!-- @include('css.main') -->
  </head>
  <body>
    
    @include('template.navbar')

    @yield('container')
    
    <!-- Required Js -->
    <script src="/assets/js/jquery-ui-1.10.3.min.js"></script>
    <script src="{{ url('/assets/bootstrap-5.2.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/jquery.blockUI.js?v=' . time()) }}"></script>
    <script type="text/javascript" src="{{ url('/assets/js/jquery.alerts.js') }}"></script>

    @yield('jsmain')
    
  </body>
</html>