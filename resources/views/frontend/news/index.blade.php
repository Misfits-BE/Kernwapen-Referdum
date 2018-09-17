@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9"> {{-- Main content --}}
            <h3>{{ config('app.name') }} - Nieuws </h3>

            @if (count($articles) > 0) {{-- There are articles found --}} 
                @foreach ($articles as $article)  {{-- Loop through the articles  --}}
                    <div class="media">
                        <div class="pull-left">
                            <a href="{{ route('news.show', ['slug' => $article->slug]) }}">
                                <img class="media-object img-rounded" src="{{ asset($article->getFirstMediaUrl('images', 'thumb')) }}" alt="{{ $article->title }}">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">{{ ucfirst($article->titel) }}</h4>
                            {{ strip_tags(markdown($article->bericht)) }}
                        </div>
                    </div>
                @endforeach {{-- /// END article loop --}}

                {{ $articles->render('vendor.pagination.simple-default') }}{{-- Pagination view instance --}}
            @else {{-- No articles are found --}}

            @endif
        </div> {{-- // Main content --}}

        <div class="col-md-3"> {{-- Sidenav --}}
            <div class="well well-sm">
            <div>
        </div> {{-- // END Sidebar --}}
    </div>
@endsection
