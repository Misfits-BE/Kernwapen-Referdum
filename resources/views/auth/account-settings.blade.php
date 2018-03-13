@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session instance --}}

        <div class="row">
            <div class="col-md-3"> {{-- Side navigation --}}
                <div class="list-group">
                    <a href="#info" aria-controls="info" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-fw fa-info-circle"></i> Account informatie
                    </a>

                    <a href="#security" aria-controls="security" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-fw fa-key"></i> Account beveiliging
                    </a>

                    <a href="#tokens" aria-controls="tokens" role="tab" data-toggle="tab" class="list-group-item">
                        <i class="fa fa-fw fa-code"></i> API Tokens
                    </a>
                </div>
            </div> {{-- /Side navigation --}}

            <div class="col-md-9"> {{-- Content --}}
                <div class="tab-content">
                    <div class="tab-pane fade in @if(Request::is('admin/account/instellingen/informatie')) active @endif" id="info" role="tabpanel">
                        @include('auth.settings.account-information')
                    </div>

                    <div class="tab-pane fade in @if (Request::is('admin/account/instellingen/beveiliging')) active @endif" id="security" role="tabpanel">
                        @include('auth.settings.account-security')
                    </div>

                    <div class="tab-pane fade in @if (Request::is('admin/account/instellingen/tokens')) active @endif" id="tokens" role="tabpanel">
                        @include('auth.settings.account-tokens')
                    </div>
                </div>
            </div> {{-- /Content --}}
        </div>
    </div>
@endsection