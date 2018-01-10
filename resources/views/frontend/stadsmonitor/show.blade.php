@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <code>{{ $city->postal }}</code> - {{ $city->name }}
                    <strong><span class="pull-right">(Informatie)</span></strong>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <p><strong>Naam stad </strong>: {{ $city->name }}</p>
                                <p><strong>Postcode </strong>: {{ $city->postal }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Provincie </strong>: {{ $city->province->name }}</p>
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


            @if (count($city->notitions) > 0) {{-- Notities gevonden --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <code>{{ $city->postal }}</code> - {{ $city->name }}
                        <strong><span class="pull-right">(Notities)</span></strong>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover">
                                <tbody>
                                    @foreach ($city->notitions as $notition)
                                        <tr>
                                            <td class="col-md-9">{{ $notition->titel }}</td>
                                            <td class="col-md-3 text-center">{{ $notition->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else {{-- Geen notities gevonden --}}
                <div class="tw-bg-blue-lightest tw-border tw-border-blue-light tw-text-blue-dark tw-px-4 tw-py-3 tw-rounded tw-relative" role="alert">
                    <strong class="tw-font-bold"><i class="fa fa-fw fa-info-circle"></i></strong>
                    <span class="tw-font-bold tw-sm:inline">info:</span>

                    <span class="tw-sm:inline">
                        Er zijn nog geen notaties voor {{ $city->name}}.
                    </span>
                </div>
            @endif
        </div>

        <div class="col-md-3">
            <div class="list-group" style="margin-bottom: 0">
                <a href="{{ route('stadsmonitor.index') }}" class="list-group-item">
                    <i class="fa fa-fw fa-arrow-left"></i> Terug naar overzicht
                </a>
            </div>

            <hr style="margin-top: 10px; margin-bottom: 10px;">

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
@endsection