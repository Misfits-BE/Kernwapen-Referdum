@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"> {{-- Signature counter --}}
                <div class="panel panel-default">
                    <div class="panel-body p-3">
                        <div class="d-flex align-items-center">
                            <span class="stamp tw-shadow stamp-md bg-red mr-3">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </span>

                            <div>
                                <h4 class="m-0"><a class="text-muted" href="">1,352 <small>Handtekeningen</small></a></h4>
                                <small class="text-muted">163 handtekeningen vandaag</small>
                            </div>
                        </div>
                    </div>
                </div>  
            </div> {{-- /// Signatures counter --}}

            <div class="col-md-3"> {{-- Kernwapen vrije gemeentes --}}
            </div> {{-- /// Kernwapen vrije gemeentes --}}

            <div class="col-md-12"> {{-- Recent signatures table --}}
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-fw fa-pencil" aria-hidden="true"></i> Recente handtekeningen
                    </div>
                    <div class="panel-body">
                    </div>
                </div>
            </div> {{-- /// Recent signatures table --}}
        </div>
    </div>   
@endsection
