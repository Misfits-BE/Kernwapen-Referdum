@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash message view instance --}}

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-list"></i> Ondersteunende organisaties

                        <div class="pull-right">
                            @if (count($organizations) > 0)
                                <a href="#" class="btn btn-link btn-xs">
                                    <i class="fa fa-search"></i> Organisatie zoeken
                                </a>
                            @endif

                            <a href="{{ route('admin.support.create') }}" class="btn btn-link btn-xs">
                                <i class="fa fa-plus"></i> Organisatie toevoegen
                            </a>
                        </div>
                    </div>

                    <div class="panel-body">

                        <div class="table-reponsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Naam:</th>
                                    <th>Contactpersoon:</th>
                                    <th>Tel nr:</th>
                                    <th colspan="2">Ingevoerd op</th> {{-- Colspan="2" is nodig voor de functies --}}
                                </tr>
                                </thead>

                                <tbody>
                                @if (count($organizations) > 0)
                                    @foreach ($organizations as $organisation) {{-- LOOP through the organisations --}}
                                        <tr>
                                            <td><strong>#{{ $organisation->id }}</strong></td>
                                            <td><a href="{{ $organisation->link }}">{{ $organisation->name }}</a></td>
                                            <td><a href="{{ $organisation->verwoordelijke_email }}">{{ $organisation->verantwoordelijke_naam }}</a></td>
                                            <td>{{ $organisation->telefoon_nr }}</td>
                                            <td>{{ $organisation->created_at->format('d/m/Y') }}</td>

                                            <td> {{-- Options --}}
                                                <span class="pull-right">
                                                    <a href="{{ route('admin.support.edit', $organisation) }}" class="text-warning">
                                                        <i class="fa fa-fw fa-pencil"></i>
                                                    </a>

                                                    <a href="{{ route('admin.support.delete', $organisation) }}" class="text-danger">
                                                        <i class="fa fa-fw fa-close"></i>
                                                    </a>
                                                </span>
                                            </td> {{-- // OPTIONS --}}
                                        </tr>
                                        @endforeach {{-- // END loop --}}
                                    @else {{-- Geen organisaties in het systeem --}}
                                        <td colspan="5">
                                            <span class="text-muted">
                                                (Er zijn geen ondersteundende organisatie gevonden.)
                                            </span>
                                        </td>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection