<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-fw fa-info-circle"></i> Account informatie:
    </div>

    <div class="panel-body">
        <form method="POST" action="{{ route('account.settings.info') }}" class="form-horizontal">
            {{ csrf_field() }} {{ method_field('PATCH') }}
            @form($user)

            <div class="form-group @error('name', 'has-error')">
                <label class="col-md-3 control-label">Gebruikersnaam: <span class="text-danger">*</span></label>

                <div class="col-md-9">
                    <input type="text" class="form-control" placeholder="Uw Gebruikersnaam" @input('name')>
                    @error('name')
                </div>
            </div>

            <div class="form-group @error('email', 'has-error')">
                <label class="col-md-3 control-label">E-mail adres: <span class="text-danger">*</span></label>

                <div class="col-lg-9">
                    <input type="email" class="form-control" placeholder="Uw E-mail adres" @input('email')>
                    @error('email')
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-9 col-md-offset-3">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-check"></i> Aanpassen
                    </button>

                    <button type="reset" class="btn btn-link btn-sm">
                        <i class="fa fa-undo"></i> Annuleren
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>