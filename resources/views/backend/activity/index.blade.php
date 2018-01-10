@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}} 

        <div class="row">
            <div class="col-md-9"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-list"></i> Activiteiten log
                    </div>

                    <div class="panel-body">
                    </div>
                </div>
            </div> {{-- /Content --}}
        </div>
    </div>
@endsection