<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}" />
        <title>Document management system - auth</title>
        <meta name="description" content="@yield('meta_description', 'DMS')">
        <meta name="author" content="@yield('meta_author', 'binaryk')">
        @yield('meta')
        @yield('before-styles-end')
        <link rel="stylesheet" href="{!! asset('angel/vendor/fontawesome/css/font-awesome.min.css')!!}">
        <link rel="stylesheet" href="{!! asset('angel/vendor/simple-line-icons/css/simple-line-icons.css')!!}">
        <link rel="stylesheet" href="{!! asset('angel/css/bootstrap.css')!!}" id="bscss">
        <link rel="stylesheet" href="css/app.css" id="maincss">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
        @yield('after-styles-end')
    </head>
    <body id="app-layout">
        <div class="container" style="margin-top: 30vh;">
            @include('includes.partials.messages')
            @yield('content')
        </div>
        <script src="{!! asset('angel/vendor/modernizr/modernizr.js') !!}"></script>
        <script src="{!! asset('angel/vendor/jquery/dist/jquery.js') !!}"></script>
        <script src="{!! asset('angel/vendor/bootstrap/dist/js/bootstrap.js')!!}"></script>
        <script src="{!! asset('angel/vendor/jQuery-Storage-API/jquery.storageapi.js') !!}"></script>
        <script src="{!! asset('angel/vendor/parsleyjs/dist/parsley.min.js')!!}"></script>
        <script src="{!! asset('js/app.js')!!}"></script>
    </body>
</html>