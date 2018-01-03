@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view include --}}

        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-fw fa-home"></i> Notitie toevoegen voor de stad: <strong>{{ $city->name }}</strong>
                    </div>

                    <div class="panel-body">
                        <form method="POST" class="form-horizontal" action="{{ route('admin.notition.store', $city) }}">
                            {{ csrf_field() }}

                            <div class="form-group @error('titel', 'has-error')">
                                <label class="control-label col-md-3">Titel: <span class="text-danger">*</span></label>
                                
                                <div class="col-md-9">
                                    <input type="text" class="form-control" @input('titel') placeholder="Titel van de notitie">
                                    @error('titel')
                                </div>
                            </div>

                            <div class="form-group @error('status', 'has-error')">
                                <label class="control-label col-md-3">Status: <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <select class="form-control" @input('status')> 
                                        <option value="0" @if (old('status') == 0) selected @endif>Publieke notitie</option>
                                        <option value="1" @if (old('status') == 1) selected @endif>Interne notitie</option>
                                    </select>
                                    
                                    @error('status') {{-- Display the error message --}}
                                </div>
                            </div>

                            <div class="form-group @error('beschrijving', 'has-error')">
                                <label class="control-label col-md-3">Beschrijving <span class="text-danger">*</span></label>

                                <div class="col-md-9">
                                    <textarea class="form-control" placeholder="Beschrijving van de notitie" @input('beschrijving') rows="7">{{ old('beschrijving') }}</textarea>
                                    @error('beschrijving')
                                </div>
                            </div>

                            <div class="form-group"> {{-- Submit and reset button --}}
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-check"></i> Opslaan
                                    </button>

                                    <button type="reset" class="btn btn-sm btn-link">
                                        <i class="fa fa-undo"></i> Reset formulier
                                    </button>
                                </div>
                            </div> {{-- /END button groups --}}
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