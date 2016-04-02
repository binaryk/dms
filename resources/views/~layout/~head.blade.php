<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bootstrap Admin App + jQuery">
    <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
    <title>@if(env('APP_ENV') === 'local' || env('APP_ENV') === 'production')Document management system @endif @if(env('APP_ENV')==='daw') Articles @endif</title>
    <meta name="csrf_token" content="{!! csrf_token() !!}"/>
    <!-- =============== VENDOR STYLES ===============-->
    <!-- FONT AWESOME-->
    {!! Html::style('angel/vendor/fontawesome/css/font-awesome.min.css')!!}
    <!-- SIMPLE LINE ICONS-->
    {!! Html::style('angel/vendor/simple-line-icons/css/simple-line-icons.css')!!}
    <!-- ANIMATE.CSS-->
    {!! Html::style('angel/vendor/animate.css/animate.min.css')!!}
    <!-- WHIRL (spinners)-->
    {!! Html::style('angel/vendor/whirl/dist/whirl.css')!!}
    <!-- =============== PAGE VENDOR STYLES ===============-->
    <!-- =============== BOOTSTRAP STYLES ===============-->
    {!! Html::style('angel/css/bootstrap.css')!!}
            <!-- =============== APP STYLES ===============-->
    {!! Html::style( 'angel/vendor/sweetalert/dist/sweetalert.css' ) !!}
    {!! Html::style( 'angel/vendor/loaders.css/loaders.css' ) !!}
    {!! Html::style( 'angel/vendor/spinkit/css/spinkit.css' ) !!}


    {!! Html::style('angel/css/app.css')!!}
    @yield('my-styles')
    @if(0)
    {!! Html::style( 'site/css/style.css' ) !!}
    @endif
    {!! Html::style( 'site/css/modal.comptech.css' ) !!}
    {!! Html::style( 'site/themes/css/flat-blue.css' ) !!}
    {!! Html::style( 'custom/css/ui.css' ) !!}


    <style>
        .ng-cloak{
            display: none !important;
        }
        .loader-spinner{
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: visible;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }

        .top-buffer { margin-top:20px; }
    </style>
    @yield('css')
</head>