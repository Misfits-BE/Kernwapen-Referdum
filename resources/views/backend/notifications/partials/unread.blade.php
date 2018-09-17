@if ($user->unreadNotifications->count() > 0) {{-- De gebruiker heeft ongelzen notificaties --}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong><i class="fa fa-bell-o"></i> Ongelezen notificaties</strong>
        </div>

        <ul class="list-group">
            @foreach ($notifications as $unread) {{-- Loop door de notificaties --}}
                <li class="list-group-item" href="{{ $unread->data['url'] }}">
                    <span style="vertical-align: middle; padding-right: 5px;" class="fa fa-fw fa-bell-o text-danger"></span>
                    <span style="vertical-align: middle;">
                            {{ $unread->data['message'] }}
                    </span>

                    <div class="pull-right">
                        <span style="padding-left: 10px; vertical-align: middle;">
                            {{ $unread->created_at->format('d/m/Y') }}
                        </span>

                        <a style="vertical-align: middle; padding-left: 15px;" href="{{ route('notifications.markOne', $unread) }}">
                            <span class="text-muted fa fa-check"></span>
                        </a>
                    </div>
                </li>
            @endforeach {{-- /// END loop --}}
        </ul>
    </div>

    {{-- Pagination view instantie --}}
    {{ $notifications->render('vendor.pagination.simple-default') }}
@else {{-- De gebruiker heeft geen ongelezen notificaties --}}
    <div class="blankslate">
        <span class="mega-octicon octicon-bell blankslate-icon"></span>
        <h3>Geen notificaties</h3>
        <p>Je hebt al je notificaties gelezen!</p>
    </div>
@endif