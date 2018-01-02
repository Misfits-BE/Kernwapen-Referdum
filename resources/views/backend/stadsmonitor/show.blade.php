@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            <div class="col-md-9"> {{-- Content --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-home fa-fw"></i> {{ $city->name }}
                    </div>

                    <div class="panel-body">
                        
                    </div>
                </div>
            </div> {{-- /Content --}}

            <div class="col-md-3">
                <div class="list-group">
                    @if ($city->kernwapen_vrij)
                        <a href="" class="list-group-item">
                            Gemeente niet kernwapen vrij verklaren. 
                        </a>
                    @else
                        <a href="" class="list-group-item">
                            Gemeente kernwapen vrij verklaren
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection