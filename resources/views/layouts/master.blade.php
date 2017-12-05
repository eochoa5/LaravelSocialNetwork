<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{URL::to('css/style.css')}}">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="{{URL::to('js/main.js')}}"></script>

        <style>

            header{
                background-color:darkblue; color:white; height:40px; text-align: center;
            }
            #body{min-height:90vh; background: lightgray; }



        </style>

    </head>
    @include('includes.header')
    <body>
    	<div id="body">@yield('content')</div>

    </body>
</html>


