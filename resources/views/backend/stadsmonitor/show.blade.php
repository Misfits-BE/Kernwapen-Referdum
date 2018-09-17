@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            <div class="col-md-9"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-home fa-fw"></i> {{ $city->postal}} - {{ $city->name }}

                        <div class="pull-right">{{ $city->signatures->count() }} Handtekeningen</div>
                    </div>

                    <div class="panel-body">
                        
                        <div class="panel well well-sm">
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <p><strong>Naam stad </strong>: {{ $city->name }}</p>
                                        <p><strong>Postcode </strong>: {{ $city->postal }}</p>
                                        <p><strong>Provincie </strong>: {{ $city->province->name }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Lengtegraad</strong>: {{ $city->lng}}</p>
                                        <p><strong>Breedtegraad</strong>: {{ $city->lat }}</p>
                                        <p>
                                            <strong>Status</strong>: 

                                            @if ($city->kernwapen_vrij) {{-- Gemeente is kernwapen vrij --}}
                                                <span class="label label-success">Kernwapen vrij</span>
                                            @else {{-- Gemeente is niet kernwapen vrij --}}
                                                <span class="label label-danger">Niet kernwapen vrij</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                </div>

                <div class="panel panel-default"> {{-- Stads activiteit --}}
                    <div class="panel-heading">
                        <i class="fa fa-list fa-fw"></i> Activiteiten historiek van {{ $city->name }}
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Autheur:</th>
                                        <th>Notitie</th>
                                        <th colspan="2">Datum:</th> {{-- Colspan="2" nodig voor de functies --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($city->notitions->count() > 0)
                                        @foreach ($city->notitions as $notition)
                                            <tr>
                                                <td>{{ $notition->author->name }}</td>
                                                <td>{{ $notition->titel }}</td>
                                                <td>{{ $notition->created_at->format('d/m/Y') }}</td>

                                                <td class="text-center"> {{-- Opties --}}
                                                    <a href="" class="text-muted" data-toggle="tooltip" data-placement="bottom" title="Wijzig notitie">
                                                        <i class="fa fa-fw fa-pencil"></i>
                                                    </a> 

                                                    <a data-toggle="tooltip" data-placement="bottom" title="Verwijder notitie" href="{{ route('admin.notition.delete', ['notition' => $notition, 'city' => $city]) }}" class="text-danger">
                                                        <i class="fa fa-close fa-fw"></i>
                                                    </a>
                                                </td> {{-- /EINDE opties --}}
                                            </tr>
                                        @endforeach 
                                    @else 
                                        <tr>
                                            <td colspan="4">(Er zijn geen notities voor de stad {{ $city->name }})</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> {{-- /Stads activiteit --}}
            </div> {{-- /Content --}}

            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('admin.stadsmonitor.index') }}" class="list-group-item">
                        <i class="fa fa-fw fa-arrow-left"></i> Terug naar overzicht
                    </a>
                </div>

                <div class="list-group">
                    @if ($city->kernwapen_vrij)
                        <a href="{{ route('admin.stadsmonitor.status', ['city' => $city->id, 'status' => 0]) }}" class="list-group-item list-group-item-danger">
                            <i class="fa fa-fw fa-undo"></i> Gemeente niet kernwapen vrij. 
                        </a>
                    @else
                        <a href="{{ route('admin.stadsmonitor.status', ['city' => $city->id, 'status' => 1]) }}" class="list-group-item list-group-item-success">
                            <i class="fa fa-fw fa-check"></i> Gemeente kernwapen vrij
                        </a>
                    @endif

                    <a href="{{ route('admin.notition.create', $city) }}" class="list-group-item">
                        <i class="fa fa-fw fa-plus"></i> Notitie toevoegen
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection