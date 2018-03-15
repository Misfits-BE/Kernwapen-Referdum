@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10">
            
                <div class="panel panel-default"> {{-- Content panel --}}
                    <div class="panel-heading"> {{-- Panel title --}}
                        Wijzig gebruiker: <strong>{{ $user->name }}</strong>
                    </div> {{-- /// Panel title --}}

                    <div class="panel-body"> {{-- Content panel body --}}

                        <form method="POST" class="form-horizontal" action="">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group">
                                <label class="control-label col-md-3">Gebruikersnaam:</label>
                            
                                <div class="col-md-9">
                                    <input type="text" disabled value="{{ $user->name }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">E-mail adres:</label>

                                <div class="col-md-9">
                                    <input type="text" disabled value="{{ $user->email }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Gebruikersrol: <span class="text-danger">*</span></label>
                            
                                <div class="col-md-9">
                                    <select class="form-control">
                                        @foreach ($roles as $role) {{-- Loop through the roles --}}
                                            <option value="{{ $role->name }}" @if ($user->hasRole($role->name) || old('role') === $role->name) selected @endif>
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-check"></i> Wijzigen
                                    </button>

                                    <a href="{{ route('admin.users.index') }}"class="btn btn-sm btn-link">
                                        <i class="fa fa-undo"></i> Annuleren
                                    </a>
                                </div>
                            </div>
                        </form>

                    </div> {{-- /// Content panel cody --}}
                </div> {{-- /// Content panel --}}

            </div>
        </div>
    </div>
@endsection