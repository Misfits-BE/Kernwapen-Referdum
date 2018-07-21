@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row"> {{-- Panel cards --}}
            <div class="col-md-3">
                <div class="panel panel-default"> {{-- Signature card --}}
                    <div class="panel-body p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp tw-shadow stamp-md bg-red mr-3">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </span>
                        <div>
                      
                        <h4 class="m-0"><a class="text-muted" href="">1,352 <small>Handtekeningen</small></a></h4>
                        <small class="text-muted">163 handtekeningen vandaag</small>
                    </div>
                </div> {{-- /// Signature card --}}
            </div>
        </div> {{-- /// Panel cards --}}
    </div>
@endsection
