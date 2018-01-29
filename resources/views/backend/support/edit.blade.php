@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                @include('flash::message') {{-- Flash session view instance --}}

                <div class="panel panel-default">
                
                    <div class="panel-heading">
                        <i class="fa fa-plus"></i> Organisatie toevoegen:
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('admin.support.update', $organisation) }}">
                            @form($organisation)        {{-- Prefill the form with the data from the database --}}
                            {{ method_field('PATCH') }}  {{-- Indicate the form has needed to be send with a PATCH http method --}}
                            {{ csrf_field() }}          {{-- Form field protection --}}

                            <fieldset> {{-- Organization name and website --}}
                                <legend>Organisatie gegevens:</legend>

                                <div class="form-group @error('name', 'has-error')">
                                    <label class="control-label col-md-3">
                                        Naam organisatie: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" placeholder="Naam van de organisatie" @input('name')>
                                        @error('name')
                                    </div>
                                </div>

                                <div class="form-group @error('link', 'has-error')">
                                    <label class="control-label col-md-3">
                                        Website v/d organisatie: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" @input('link') placeholder="http(s)://">
                                        @error('link')
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <legend>Contactgegevens organisatie:</legend>

                                <div class="form-group @error('verantwoordelijke_naam', 'has-error')">
                                    <label class="control-label col-md-3">
                                        Naam: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" @input('verantwoordelijke_naam') placeholder="Naam contact persoon">
                                        @error('verantwoordelijke_naam')
                                    </div>
                                </div>

                                <div class="form-group @error('verantwoordelijke_email', 'has-error')">
                                    <label class="control-label col-md-3">
                                        E-mail adres: <span class="text-danger">*</span>
                                    </label>

                                    <div class="col-md-9">
                                        <input type="email" class="form-control" @input('verantwoordelijke_email') placeholder="E-mail adres van de verantwoordelijke">
                                        @error('verantwoordelijke_email')
                                    </div>
                                </div>

                                <div class="form-group @error('telefoon_nr', 'has-error')">
                                    <label class="control-label col-md-3">
                                        Telefoon nr: {{-- <span class="text-danger">*</span> --}}
                                    </label>

                                    <div class="col-md-9">
                                        <input type="tel" placeholder="Telefoon nr van de verantwoordelijke" class="form-control" @input('telefoon_nr')>
                                        @error('telefoon_nr')
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset>
                                <div class="form-group">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn btn-sm btn-primary">
                                            <i class="fa fa-check"></i> Wijzigen
                                        </button>

                                        <a href="{{ route('admin.support.index') }}" class="btn btn-sm btn-link">
                                            <i class="fa fa-undo"></i> Annuleren
                                        </a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection