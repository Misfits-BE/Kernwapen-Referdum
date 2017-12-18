@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <h3>Laat Belgie nuclaire wapens verbieden.</h3>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui dicta minus molestiae vel beatae natus eveniet ratione temporibus aperiam harum alias officiis assumenda officia quibusdam deleniti eos cupiditate dolore doloribus!</p>
            <p>Ad dolore dignissimos asperiores dicta facere optio quod commodi nam tempore recusandae. Rerum sed nulla eum vero expedita ex delectus voluptates rem at neque quos facere sequi unde optio aliquam!</p>
            <p>Tenetur quod quidem in voluptatem corporis dolorum dicta sit pariatur porro quaerat autem ipsam odit quam beatae tempora quibusdam illum! Modi velit odio nam nulla unde amet odit pariatur at!</p>
            <p>Consequatur rerum amet fuga expedita sunt et tempora saepe? Iusto nihil explicabo perferendis quos provident delectus ducimus necessitatibus reiciendis optio tempora unde earum doloremque commodi laudantium ad nulla vel odio?</p>

            <hr>

            <form method="POST" class="form-horizontal" action="">
                {{ csrf_field() }} {{-- CSRF token protection --}}

                <div class="form-group">
                    <label class="control-label col-md-3"> Uw naam: <span class="text-danger">*</span></label>

                    <div class="col-md-4">
                        <input type="text" class="form-control" placeholder="Uw voornaam">

                    </div>

                    <div class="col-md-5">
                        <input type="text" class="form-control" placeholder="Uw achternaam">
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Geboortedatum: <span class="text-danger">*</span> </label>

                    <div class="col-md-9">
                    <input type="date" class="form-control">
                </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3"> Uw adres: <span class="text-danger">*</span></label>

            <div class="col-md-6 @error('address' , 'has-error')">
                <input type="text" class="form-control" placeholder="Uw straatcnaam">
            </div>

            <div class="col-md-3 @error('house_number', 'has-error')">
                <input type="text" class="form-control" placeholder="Uw Huisnummer">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-3 @error('postal_code', 'has-error')">
                <input type="text" class="form-control" placeholder="Stadsnaam">
            </div>

            <div class="col-md-6">
                <input type="text" class="form-control" placeholder="Stadsnaam">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-offset-3 col-md-9">
                <button type="submit" class="btn btn-sm btn-success">
                    <i class="fa fa-check"></i> Tekenen
                </button>

                <button type="reset" class="btn btn-sm btn-link">
                    <i class="fa fa-undo"></i> Annuleren
                </button>
            </div>
        </div>
        </form>

        </div>

        <div class="col-md-3">
            <div class="p-30">
                <a class="btn btn-block btn-social btn-facebook">
                    <span class="fa fa-facebook"></span>
                    Deel op facebook
                </a>
                <a class="btn btn-block btn-social btn-twitter">
                    <span class="fa fa-twitter"></span>
                    Deel op Twitter
                </a>
            </div>
        </div>
    </div>
@endsection