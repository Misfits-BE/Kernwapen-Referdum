@extends('layouts.app')

@section('content')
    <div class="tw-bg-blue-lightest tw-border tw-border-blue-light tw-text-blue-dark tw-px-4 tw-py-3 tw-rounded tw-relative" role="alert">
        <strong class="tw-font-bold">
            <i class="fa fa-fw fa-info-circle"></i>
        </strong>
        <span class="tw-font-bold tw-sm:inline">
            Waarschijnlijk wordt uw vraag beantwoord in de <a class="tw-underline" href="">FAQ</a>.
        </span>

        <br><br>

        <span class="tw-sm:inline">
            Indien je vraag niet beantwoord word in de FAQ.
            Of ons gewoon een berichtje wilt nalaten. Dan kan dat via het onderstaande formulier.
            Verder zijn wij als organisatie ook Actief op Facebook en Twitter.
        </span>
    </div>

    <form class="tw-mt-8" method="POST">
        {{ csrf_field() }}

        <div class="row">
            <div class="col-md-6">
                <div class="form-group @error('name', 'has-error')">
                    <label for="name">Naam: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" placeholder="Uw naam" @input('name')/>
                    @error('name')
                </div>
                
                <div class="form-group @error('onderwerp', 'has-error')">
                    <label for="onderwerp">Onderwerp: <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="onderwerp" placeholder="Onderwerp" @input('onderwerp')>
                </div>

                <div class="form-group @error('email', 'has-error')">
                    <label for="email">Email Adres: <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                        <input type="email" class="form-control" id="email" placeholder="Uw email adres" @input('email')/></div>
                    @error('email')
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group @error('message', 'has-error')">
                    <label for="name">Bericht: <span class="text-danger">*</span></label>
                    <textarea @input('message') id="Uw bericht" class="form-control" rows="9" cols="25" placeholder="Message"></textarea>
                    @error('message')
                </div>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-success pull-right">
                    <i class="fa fa-check"></i> Verzenden
                </button>
            </div>
        </div>
    </form>
@endsection