<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-fw fa-key"></i> Creer API token
    </div>

    <div class="panel-body">
        <form action="" method="POST" class="form-horizontal">
            {{ csrf_field() }} {{-- CSRF form protection --}}

            <div class="form-group">
                <div class="col-md-12">
                    <input type="text" name="service" class="form-control" placeholder="Naam van je applicatie.">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-sm btn-success">
                        <span class="fa fa-check" aria-hidden="true"></span> Toevoegen
                    </button>

                    <button class="btn btn-sm btn-link" type="reset">
                        <span class="fa fa-undo" aria-hidden="true"></span> Annuleren
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-list"></i> Mijn API tokens
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-condensed table-hover">
                <thead>
                    <th>Applicatie</th>
                    <th colspan="2">Sleutel</th> {{-- Colspan="2" nodig voor de functies --}}
                </thead>
                <tbody>
                    @if ()
                        @foreach () 
                        @endforeach
                    @else 
                    @endif
                </tbody>
            </table> 
        </div>
    </div>
</div>