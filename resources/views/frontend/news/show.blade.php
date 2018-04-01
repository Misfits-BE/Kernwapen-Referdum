@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9"> {{-- Main content --}}
            <h3>{{ $article->titel }}</h3>

            {{-- // TODO: Implement markdown helpder --}}  
        </div> {{-- // Main content --}}

        <div class="col-md-3">
            <div class="p-30"> 
                <div class="list-group">
                    <a href="{{ route('news.index') }}" class="list-group-item">
                        <i class="fa fa-fw fa-arrow-left"></i> Terug naar overzicht
                    </a>


                </div>
            </div>
        </div>
    </div>
@endsection
