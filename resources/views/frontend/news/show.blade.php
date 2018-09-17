@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9"> {{-- Main content --}}
            <h3>{{ ucfirst($article->titel) }}</h3>
            {!! ucfirst(markdown($article->bericht)) !!}  

            <hr style="margin-top: 15px; margin-bottom: 5px;">
            <small class="text-muted">1 week geleden gepubliceerd door <strong>Voornaam Achternaam</strong></small> 
        </div> {{-- // Main content --}}

        <div class="col-md-3">
            <div class="p-30"> 
                <div class="list-group">
                    <a href="{{ route('news.index') }}" class="list-group-item">
                        <i class="fa fa-fw fa-arrow-left"></i> Terug naar overzicht
                    </a>

                    <hr style="margin-top: 15px; margin-bottom: 15px;">

                    <a href="" class="btn btn-block btn-social btn-facebook">
                        <span class="fa fa-facebook"></span>
                        Deel op facebook
                    </a>
                    
                    <a href="" class="btn btn-block btn-social btn-twitter">
                        <span class="fa fa-twitter"></span>
                        Deel op Twitter
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
