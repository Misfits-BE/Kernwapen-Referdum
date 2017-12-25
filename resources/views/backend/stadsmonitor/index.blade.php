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
                                                <td>{{ $city->postal }}</td>
                                                <td></td> {{-- TODO: Verweef de status --}}
                                                <td>{{ $city->name }}</td>
                                                <td>{{ $city->province->name }}</td>
                                                
                                                <td class="text-center"> {{-- Options --}}
                                                    <a href="" class="text-muted">
                                                        <i class="fa fa-fw fa-info-circle"></i>
                                                    </a>

                                                    <a href="">
                                                        <i class="fa fa-fw fa-check text-success"></i>
                                                    </a>
                                                </td> {{-- /Options --}}
                                            </tr>
                                        @endforeach
                                    @else 
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-3">
                <div class="well well-sm"> {{-- Search function --}}
                    Zoek functie
                </div> {{-- /Search function --}}

                <div class="panel panel-success"> {{-- Teller voor kernvrije gemeentes --}}
                     <div class="panel-body" style="padding-top: 5px;">
                        <h4 style="padding-top:0"><strong>0</strong></h4>
                        <span class="text-muted">Kernvrije gemeentes</span>
                    </div>
                </div> {{-- /Teller voor kernvrije gemeentes --}}
            </div>
        </div>
    </div>
@endsection