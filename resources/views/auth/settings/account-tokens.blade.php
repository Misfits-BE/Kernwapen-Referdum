<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-fw fa-key"></i> Creer API token
    </div>

    <div class="panel-body">
        <form action="{{ route('admin.apikey.store') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }} {{-- CSRF form protection --}}

            <div class="form-group @error('service', 'has-error')">
                <div class="col-md-12">
                    <input type="text" @input('service') class="form-control" placeholder="Naam van je applicatie.">
                    @error('service')
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
                    <th>Sleutel</th>
                    <th colspan="2">Laast gebruikt</th> {{-- Colspan="2" nodig voor de functies --}}
                </thead>
                <tbody>
                    @if (count($apiKeys) > 0) {{-- API tokens found --}}
                        @foreach ($apiKeys as $apikey) {{-- Loop through the account api keys --}} 
                            <tr>
                                <td><strong>{{ $apikey->service }}</strong></td>
                                <td><code>{{ $apikey->key }}</code></td>
                                <td>{{ $apikey->last_used_at }}</td>

                                <td> {{-- Options --}}
                                    {{-- //TODO: Implement tooltips --}}
                                    <span class="pull-right">
                                        <a class="text-muted">
                                            <i class="fa fa-fw fa-refresh"></i>
                                        </a>

                                        <a class="text-danger" href="">
                                            <i class="fa fa-fw fa-trash"></i>
                                        </a>
                                    </span>
                                </td> {{-- /// END options --}}
                            </tr>
                        @endforeach {{-- END loop --}}
                    @else {{-- No api keys found --}}
                        <tr>
                            <td colspan="3"><span class="text-muted">(Er zijn geen API tokens voor jouw account)</span></td>
                        </td>
                    @endif
                </tbody>
            </table> 
        </div>
    </div>
</div>