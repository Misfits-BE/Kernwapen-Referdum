@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message') {{-- Flash session view instance --}}

        <div class="row">
            <div class="col-md-3"> {{-- Sidebar --}}
                <div class="list-group">
                    <a href="#unread" aria-controls="unread" role="tab" data-toggle="tab" class="list-group-item">
                        <span class="fa fa-fw fa-bell-o"></span> Ongelezen notificaties
                    </a>

                    @if ($user->unreadNotifications->count() > 0)
                        <a href="{{ route('notifications.markall') }}" class="list-group-item">
                            <span class="fa fa-fw fa-check"></span> Markeer alles als gelezen
                        </a> 
                    @endif
                </div>
            </div> {{-- /// Sidebar --}}

            <div class="col-md-9"> {{-- Content --}}
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="unread"> {{-- Unread notifications tab --}}
                        @include('backend.notifications.partials.unread') {{-- Unread notification partial --}}
                    </div> {{-- /// Unread notifications tab --}}
                </div>
            </div> {{-- /// Content --}}
        </div>
    </div>
@endsection