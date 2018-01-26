@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}} 

        <div class="row">
            <div class="col-md-9"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-list"></i> Activiteiten log
                    </div>

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th class="col-md-3">Gebruiker:</th>
                                        <th colspan="2">Bericht:</th> {{-- Nodig voor de datum --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($activities) == 0) {{-- Er zijn geen activiteiten gevonden in het systeem. --}}
                                        <tr>
                                            <td colspan="3"><i>(Er zijn geen logs van activiteiten in het systeem gevonden)</i></td>
                                        </tr>
                                    @else {{-- Er zijn activiteiten gevonden in het systeem. --}}
                                        @foreach ($activities as $activity) {{-- Loop door de activiteiten --}}
                                            <tr>
                                                <td>{{ $activity->causer->name }}</td>
                                                <td>{{ $activity->description }}</td>
                                                <td class="text-center">{{ $activity->created_at->format('d/m/Y H:i:s') }}</td>
                                            </tr>
                                        @endforeach {{-- END loop --}}
                                    @endif
                                </tbody>
                            </table>
                        </div>

                        {{ $activities->render() }}
                    </div>
                </div>
            </div> {{-- /Content --}}

            <div class="col-md-3"> {{-- Sidenav --}}
                <div class="well well-sm" style="margin-bottom: 0px;"> {{-- Search --}}
                    <form method="GET" action="{{ route('admin.logs.search') }}">
                        <div class="input-group">
                            <input type="text" name="term" placeholder="Zoek een stad" class="form-control">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-success">
                                    <i aria-hidden="true" class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div> {{-- /// Search --}}
            </div> {{-- /// Sidenav --}}
        </div>
    </div>
@endsection