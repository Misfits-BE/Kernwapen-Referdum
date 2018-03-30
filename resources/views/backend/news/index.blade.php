@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-12"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-fw fa-file-text-o"></i> Nieuwsberichten

                        <span class="pull-right">
                            <a href="" class="btn btn-link btn-xs">
                                <i class="fa fa-search"></i> Nieuwsbericht zoeken
                            </a>

                            <a href="{{ route('admin.news.create') }}" class="btn btn-link btn-xs">
                                <i class="fa fa-plus"></i> Nieuwsbericht toevoegen
                            </a>
                        </span>
                    </div>

                    <div class="panel-body">
                        <div class="tabke-responsive">
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Autheur</th>
                                        <th>Status</th>
                                        <th>Titel</th>
                                        <th colspan="2">Aangemaakt op:</th> {{-- Colspan="2" nodig voor de functies --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($articles) > 0) {{-- Artikelen gevonden in het systeem --}}
                                        @foreach ($articles as $article)
                                            <tr>
                                                <td><strong>#{{ $article->id }}</strong></td>
                                                <td>{{ $article->author->name }}</td>
                                                <td>
                                                    @if ($article->is_public)
                                                        <span class="label label-success"><i class="fa fa-fw fa-check"></i> Gepubliceerd</span>
                                                    @else {{-- Draft version --}}
                                                        <span class="label label-warning"><i class="fa fa-fw fa-file-text-o"></i> Klad versie</span>
                                                    @endif
                                                </td>
                                                <td>{{ $article->titel }}</td>
                                                <td>{{ $article->created_at->format('d/m/Y H:i') }}</td>

                                                <td> {{-- Options --}}
                                                    <span class="text-center">
                                                        <a href="{{ route('admin.news.edit', ['slug' => $article->slug]) }}" class="text-warning" data-toggle="tooltip" data-placement="bottom" title="Wijzig">
                                                            <i class="fa fa-fw fa-pencil"></i>
                                                        </a>

                                                        <a href="{{ route('admin.news.destroy', ['slug' => $article->slug]) }}" class="text-danger" data-toggle="tooltip" data-placement="bottom" title="Verwijder">
                                                            <i class="fa fa-fw fa-close"></i>
                                                        </a>
                                                    </span>
                                                </td> {{-- /// END options --}}
                                            </tr>
                                        @endforeach {{-- /// Einde loop v/d artikelen --}}
                                    @else {{-- Geen artikelen gevonden --}}
                                        <tr>
                                            <td colspan="6">
                                                <span class="text-muted">(Er zijn nog geen nieuwsberichten gevonden.)</span>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{ $articles->render() }} {{-- Pagination instance --}}
                    </div>
                </div>
            </div> {{-- /// Content --}}
        </div>
    </div>
@endsection
