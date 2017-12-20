<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-fw fa-key"></i> Account beveiliging
    </div>

    <div class="panel-body">
        <form method="POST" action="{{ route('account.settings.security') }}" class="form-horizontal">
            {{ csrf_field() }} {{ method_field('PATCH') }}

            <div class="form-group">
                <label class="control-label col-md-3">Wachtwoord: <span class="text-danger">*</span></label>

                <div class="col-md-9 @error('password', 'has-error')">
                    <input type="password" class="form-control" placeholder="Uw nieuw wachtwoord" @input('password')>
                    @error('password')
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3">Herhaal wachtwoord: <span class="text-danger">*</span></label>

                <div class="col-md-9 @error('password_confirmation')">
                    <input type="password" class="form-control" placeholder="Herhaal het wachtwoord" @input('password_confirmation')>
                    @error('password_confirmation')
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-check"></i> Aanpassen
                    </button>

                    <button type="reset" class="btn btn-sm btn-link">
                        <i class="fa fa-undo"></i> Annuleren
                    </button>
                </div>
            </div>
        </form> 
    </div>
</div>