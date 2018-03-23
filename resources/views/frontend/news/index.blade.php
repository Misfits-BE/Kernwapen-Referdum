@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9"> {{-- Main content --}}
            <h3>{{ config('app.name') }} - Nieuws </h3>

            @if (count($articles) > 0) {{-- There are articles found --}} 
                @foreach ($articles as $article)  {{-- Loop through the articles  --}}
                @endforeach {{-- /// END article loop --}}

                {{ $articles->render('vendor.pagination.simple-default') }}{{-- Pagination view instance --}}
            @else {{-- No articles are found --}}
            @endif
        </div> {{-- // Main content --}}
    </div>
@endsection
