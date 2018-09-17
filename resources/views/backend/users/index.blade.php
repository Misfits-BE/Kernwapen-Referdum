@extends('layouts.backend')

@section('content')
    <div class="container">
        @include('flash::message')

        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-user"></i> Gebruikersbeheer

                        <span class="pull-right">
                            @if (count($users) > 15)
                                <a href="" class="btn btn-xs btn-link">
                                    Gebruiker zoeken
                                </a>
                            @endif

                            <a href="{{ route('admin.users.create') }}" class="btn btn-xs btn-link">
                                <i class="fa fa-plus"></i> Nieuwe gebruiker
                            </a>
                        </span>
                    </div>

                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-condensed table-hover table-sm">
                                <thead>
                                    <th>#</th>
                                    <th>Status:</th>
                                    <th>Naam:</th>
                                    <th>Email:</th>
                                    <th colspan="2">Toegevoegd op:</th> {{-- Colspan 2 = nodig voor functies --}}
                                </thead>
                                <tbody>
                                    @if (count($users) > 0) {{-- Users found --}}
                                        @foreach ($users as $user) {{-- Loop through users --}}
                                            <tr>
                                                <td><strong>#{{ $user->id }}</strong></td>
                                                <td> {{-- Status --}}
                                                    @if ($user->isOnline()) <span class="label label-success">Online</span>
                                                    @else <span class="label label-danger">Offline</span>
                                                    @endif

                                                    @if ($user->isBanned())
                                                        <span class="label label-danger">Geblokkeerd</span>
                                                    @endif
                                                </td> {{-- /END status --}}
                                                <td>{{ $user->name }}</td>
                                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                                <td>{{ $user->created_at->format('d/m/Y') }}</td>

                                                <td> {{-- Opties --}}
                                                    <span class="pull-right">
                                                        <a href="{{ route('admin.users.edit', $user) }}" class="text-muted">
                                                            <i class="fa fa-fw fa-cogs"></i>
                                                        </a>

                                                        @can('ban', $user)
                                                            @if ($user->isNotBanned())
                                                                <a href="{{ route('admin.users.lock', $user) }}" class="text-danger">
                                                                    <i class="fa fa-fw fa-lock"></i>
                                                                </a>
                                                            @elseif ($user->isBanned())
                                                                <a href="{{ route('admin.users.active', $user) }}" class="text-success">
                                                                    <i class="fa fa-fw fa-unlock"></i>
                                                                </a>
                                                            @endif
                                                        @endcan

                                                        <a href="{{ route('admin.users.delete', $user) }}" class="text-danger">
                                                            <i class="fa fa-fw fa-close"></i>
                                                        </a>
                                                    </span>
                                                </td> {{-- /Opties --}}
                                            </tr>
                                        @endforeach
                                    @else {{-- Geen gebruikers gevonden. --}}
                                        <tr>
                                            <td colspan="6">Er zijn geen gebruikers gevonden in het systeem.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection