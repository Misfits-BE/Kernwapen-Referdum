@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-fw fa-undo" aria-hidden="true"></i> 
                        Kernwapen vrij statuut intrekken voor <strong>{{ $city->name}}</strong>
                    </div>

                    <div class="panel-body">
                        <p class="text-danger">
                            <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                            U staat op het punt om een kernwapen vrij statuut voor een gemeente in te trekken.
                        </p>

                        <p>
                            Als u zeker bent van deze keuze dan kunt het statuut nietig verklaren door het ingeven van je 
                            wachtwoord <br> onderaan in het formulier als controle.
                        </p>

                        <hr>

                        <form method="POST" action="{{ route('admin.stadsmonitor.nuke-not-free', $city) }}" class="form-horizontal">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}    {{-- HTTP method spoofing --}}

                            <div class="form-group">
                                <label for="bevestiging" class="control-label col-md-2">
                                    Bevestiging <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-4 @error('bevestiging', 'has-error')">
                                    <input type="password" placeholder="Uw wachtwoord ter bevestiging" @input('bevestiging') class="form-control">
                                    @error('bevestiging')
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-10">
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Bevestig
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