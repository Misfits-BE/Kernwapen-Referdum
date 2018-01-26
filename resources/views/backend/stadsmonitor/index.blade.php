@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    
                    <div class="panel-heading">
                        <i class="fa fa-fw fa-home"></i> Gemeentes
                    </div>

                    <div class="panel-body">
                        <div class="table-reponsive">
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Postcode:</th>
                                        <th>Status</th>
                                        <th>Stadsnaam:</th>
                                        <th colspan="2">Provincie</th> {{-- Colspan="2" nodig voor de functies --}}
                                    <tr>
                                </thead>
                                <tbody>
                                    @if (count($cities) > 0)
                                        @foreach ($cities as $city) 
                                            <tr>
                                                <td><strong>{{ $city->postal }}</strong></td>

                                                <td>
                                                    @if ($city->kernwapen_vrij) {{-- Heeft zich kernwapen vrij verklaard --}}
                                                        <span class="label label-success">Kernwapen vrij</span>
                                                    @elseif (! $city->kernwapen_vrij)  {{-- Is niet kernwapen vrij --}}
                                                        <span class="label label-danger">Niet kernwapen vrij</span>
                                                    @else {{-- Status onbekend --}}
                                                        <span class="label label-warning">Onbekend</span>
                                                    @endif
                                                </td>

                                                <td>{{ $city->name }}</td>
                                                <td>{{ $city->province->name }}</td>
                                                
                                                <td class="text-center"> {{-- Options --}}
                                                    <a href="{{ route('admin.stadsmonitor.show', $city) }}" class="text-muted" data-toggle="tooltip" data-placement="bottom" title="Informatie">
                                                        <i class="fa fa-fw fa-info-circle"></i>
                                                    </a>

                                                    @if ($city->kernwapen_vrij)
                                                        <a href="{{ route('admin.stadsmonitor.status', ['city' => $city->id, 'status' => 0]) }}" data-toggle="tooltip" data-placement="bottom" title="Niet kernwapen vrij">
                                                            <i class="fa fa-fw fa-undo text-warning"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('admin.stadsmonitor.status', ['city' => $city->id, 'status' => 1]) }}" data-toggle="tooltip" data-placement="bottom" title="Kernwapen vrij">
                                                            <i class="fa fa-fw fa-check text-success"></i>
                                                        </a>
                                                    @endif
                                                </td> {{-- /Options --}}
                                            </tr>
                                        @endforeach
                                    @else 
                                        <tr>
                                            <td colspan="5">
                                                <span class="text-muted"><i>(Er zijn geen steden in de stadsmonitor gevonden.)</i></td>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{ $cities->render() }}
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="well well-sm"> {{-- Search function --}}
                    <form method="GET" action="{{ route('admin.stadsmonitor.search') }}">
                        <div class="input-group">
                            <input type="text" name="term" class="form-control" placeholder="Zoek een stad">
                            <span class="input-group-btn">
                                <button class="btn btn-success" type="button">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div> {{-- /Search function --}}

                <div class="panel panel-success"> {{-- Teller voor kernvrije gemeentes --}}
                     <div class="panel-body" style="padding-top: 5px;">
                        <h4 style="padding-top:0"><strong>{{ $kernvrijeGemeentes }}</strong></h4>
                        <span class="text-muted">Kernvrije gemeentes</span>
                    </div>
                </div> {{-- /Teller voor kernvrije gemeentes --}}
            </div>
        </div>
    </div>
@endsection