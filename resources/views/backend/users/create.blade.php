@extends('layouts.backend')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-offset-1 col-md-10">
                @include('flash::message')

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-plus"></i> Nieuwe gebruiker toevoegen
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="alert alert-warning alert-important" role="alert">
                                        <strong><i class="fa fa-warning"></i> Info:</strong>
                                        Er word automatisch een wachtwoord gegenereerd voor de gebruiker.
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" @error('name', 'has-error')>
                                <label for="username" class="control-label col-md-3">
                                    Gebruikersnaam: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" placeholder="De gebruikersnaam" @input('name')>
                                    @error('name')
                                </div>
                            </div>

                            <div class="form-group @error('email', 'has-error')">
                                <label for="email" class="form-control col-md-3">
                                    E-mail adres: <span class="text-danger">*</span>
                                </label>

                                <div class="col-md-9">
                                    <input type="email" class="form-control" placeholder="Het E-mail adres van de gebruiker" @input('email')>
                                    @error('email')
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-check"></i> Aanmaken
                                    </button>

                                    <a href="{{ route('admin.users.index') }}" class="btn btn-link btn-sm">
                                        <i class="fa fa-undo"></i> Annuleren
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection