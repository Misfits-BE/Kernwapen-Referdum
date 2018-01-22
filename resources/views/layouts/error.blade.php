<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="@yield('title')">
        
        <title>@yield('title')</title>

        <link href="{{ asset('css/errors.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    
        <script type="text/javascript">
            function loadDomain() {
                var display = document.getElementById('display-domain');
                display.innerHTML = document.domain;
            }
        </script>
    </head>
    <body onload="javascript::loadDomain()">
        {{-- Error page content --}}
            @yield('content')
        {{-- /Error page content --}}
    
        {{-- Scripts --}}
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        {{-- /Scripts --}}
    </body>
</html>