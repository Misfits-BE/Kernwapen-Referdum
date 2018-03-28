@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-fw fa-plus"></i> Nieuwsbericht toevoegen
                    </div>

                    <div class="panel-body">
                        <form method="POST" action="" class="form-horizontal" enctype="multipart/form-data">
                            {{ csrf_field() }} {{-- Form field protection --}}

                            <div class="form-group @error('titel', 'has-error')">
                                <label class="col-md-3 control-label">Titel nieuwsbericht: <span class="text-danger">*</label></label>
                                
                                <div class="col-md-9">
                                    <input type="text" class="form-control" @input('titel') placeholder="Titel van het nieuwsbericht">
                                    @error('titel')
                                </div>
                            </div>

                            <div class="form-group @error('is_public', 'has-error')">
                                <label class="col-md-3 control-label">Status nieuwsbericht <span class="text-danger">*</span></label>
                                
                                <div class="col-md-9">
                                    <select @input('is_public') class="form-control">
                                        <option value="0">Dit is een klad versie van een nieuwsbericht</option>
                                        <option value="1">Ik wil dit nieuwsbericht publiceren</option>
                                    </select>

                                    @error('is_public') {{-- validation error view instance --}}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">Nieuwsbericht: <span class="text-danger">*</span></label>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-fw fa-check"></i> Opslaan
                                    </button>

                                    <a href="" class="btn btn-sm btn-danger">
                                        <i class="fa fa-fw fa-undo"></i> Formulier legen
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
