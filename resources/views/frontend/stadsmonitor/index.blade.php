@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9"> {{-- Inhoud steden --}}
            <div class="table-responsive">
                <table class="table table-responsive table-condensed table-hover">
                    <thead>
                        <th>Status:</th>
                        <th>Postcode</th>
                        <th>Provincie</th>
                        <th colspan="2">Naam:</th> {{-- Voor de show button --}}
                    </thead>
                    <tbody>
                        @if (count($cities) == 0) {{-- IF/ELSE nodig voor de zoekopdracht in het systeem --}}
                            <tr>
                                <td colspan="4">Er zijn geen steden gevonden in het systeem voor je.</td>
                            </tr>
                        @else {{-- Er zijn steden gevonden --}}
                            @foreach ($cities as $city) {{-- Loop door de gemeentes --}}
                                <tr>
                                    <td>
                                        @if ($city->kernwapen_vrij)
                                            <span class="label label-success">Kernwapen vrij</span>
                                        @else
                                            <span class="label label-danger">Niet kernwapen wrij</span>
                                        @endif
                                    </td>
                                    <td><strong>{{ $city->postal }}</strong></td>
                                    <td>{{ $city->province->name }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td class="text-center">
                                        <a href="" class="btn btn-xs btn-default">
                                            <i class="fa fa-fw fa-info-circle"></i> Info
                                        </a>
                                    </td>
                                </tr>
                            @endforeach {{-- END loop --}}
                        @endif
                    </tbody>
                </table>

                @if (count($cities) > 0) {{-- Terminate if the pagination view instance is needed --}}
                    {{ $cities->render('vendor.pagination.simple-default') }}
                @endif
            </div>
        </div> {{-- /Stads inhoud --}}

        <div class="col-md-3"> {{-- Side content --}}
            <div class="well well-sm" style="margin-bottom: 0"> {{-- Search form --}}
                <form method="POST" action="">
                    {{ csrf_field() }} {{-- Form field protection --}}

                    <div class="input-group">
                        <input type="text" name="term" class="form-control" placeholder="Zoek een stad">
                        <span class="input-group-btn">
	                   		<button class="btn btn-success" type="button">
	                   			<i class="fa fa-search" aria-hidden="true"></i>
	                   		</button>
	                    </span>
                    </div>
                </form>
            </div> {{-- /Search form --}}

            <hr style="margin-top: 10px; margin-bottom: 10px;">

            <div class="panel panel-default" style="margin-bottom: 0"> {{-- Nuclear free counter --}}
                <div class="panel-body" style="padding-top: 5px;">
                    <h4 style="padding-top:0"><strong>{{ $counter }}</strong></h4>
                    <span class="text-muted">Kernvrije gemeentes</span>
                </div>
            </div> {{-- /Nuclear free counter --}}

            <hr style="margin-top: 10px; margin-bottom: 10px;">

            <a href="" class="btn btn-block btn-social btn-facebook">
                <span class="fa fa-facebook"></span>
                Deel op facebook
            </a>
            <a href="" class="btn btn-block btn-social btn-twitter">
                <span class="fa fa-twitter"></span>
                Deel op Twitter
            </a>
        </div> {{-- /Side content --}}
    </div>
@endsection