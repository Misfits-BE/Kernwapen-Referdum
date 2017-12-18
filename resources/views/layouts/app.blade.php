<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container" id="app">
    <div class="row">
        <div class="col-md-offset-1 col-md-10 text-center" style="padding-top:20px;">
            <img class="img-rounded tw-shadow-md front-image" src="{{ asset('img/ican.jpg') }}">
        </div>

        <div class="col-md-offset-1 col-md-10 text-color">
            <div class="panel panel-default tw-shadow-md">
                <div class="panel-body">

                    <ul class="nav nav-tabs" role="tablist"> <!-- Tab menu -->
                        <li role="presentation" @if (Request::is('/')) class="active" @endif>
                            <a href="{{ route('frontend.index') }}">Uitleg</a>
                        </li>
                        <li role="presentation" @if (Request::is('disclaimer')) class="active" @endif>
                            <a href="{{ route('disclaimer.index') }}">Disclaimer</a>
                        </li>
                    </ul> <!-- /END Tab menu -->

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="home" style="margin-top:10px;">
                            @yield('content')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="{{ asset('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>