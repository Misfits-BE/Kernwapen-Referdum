@extends('layouts.backend')

@section('content')
    <div class="container">
        @include ('flash::message') {{-- Flash session view include --}}

        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-fw fa-pencil" aria-hidden="true"></i>
                        <strong>{{ $city->name}}</strong> kernwapen vrij verklaren.
                    </div>

                    <div class="panel-body">
                        <p>
                            U staat op het punt om een gemeente kernwapen vrij te verklaren. Dit kan alleen gebeuren
                            als er een schriftelijk bewijs is van de schepenen en of burgemeester van {{ $city->name }}.
                        </p>

                        <p>
                            Deze verklaring zult u mee moeten uploaden. Zodat deze openbaar kan worden geplaatst voor de bezoekers
                            en medewerkers van die actie. 
                        </p>

                        <hr>

                        <form method="POST" action="" class="form-horizontal">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group">
                                <label class="col-md-3 control-label" for="verklaring">Verklaring <span class="text-danger">*</span></label>
                                
                                <div class="col-md-9 @error('verklaring', 'has-error')">
                                    <input type="file" id="verklaring" @input('verklaring')>
                                    @error('verklaring')
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-success">
                                        Vrij verklaren
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('admin.stadsmonitor.show', $city) }}" class="list-group-item">
                        <i class="fa fa-fw fa-arrow-left"></i> Terug naar het stads overzicht
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection