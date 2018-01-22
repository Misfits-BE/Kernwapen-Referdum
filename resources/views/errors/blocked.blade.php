@extends('layouts.error')

@section('title', 'Geen toegang')

@section('content')
    <div class="container">
        <div class="jumbotron">
            <h1><i class="fa fa-ban red"></i> @yield('title')</h1>
            <p class="lead">Sorry! Uw account is helaas geblokkeerd in het domain <em><span id="display-domain"></span></em>.</p>
            
            <p>
                <a onclick=javascript:checkSite(); class="btn btn-default btn-lg green">
                    <i class="fa fa-undo"></i> Ga terug
                </a>
                
                <a href="mailto:{{ config('platform.author.email') }}" class="btn btn-primary btn-lg">
                    <i class="fa fa-envelope"></i> Contact
                </a>

                <script type="text/javascript">
                    function checkSite() {
                        var currentSite = window.location.hostname; 
                        window.location = "https://" + currentSite;
                    }
                </script>
            </p>
        </div>
    </div>
@endsection