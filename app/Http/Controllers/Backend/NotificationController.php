<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\NotificationRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Controller voor de applicatie notificaties.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \App\Http\Controllers\Backend
 */
class NotificationController extends Controller
{
    /** @var \App\Notifications\NotificationRepository $notifications */
    private $notifications;

    /**
     * NotificationController Constructor
     *
     * @param  NotificationRepository $notifications De abstractie laag tussen notifications in de databank en controller
     * @return void
     */
    public function __construct(NotificationRepository $notifications)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->notifications = $notifications;
    }

    /**
     * Index pagina voor de notificaties.
     *
     * @todo implementatie phpunit tests
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.notifications.index', [
            'notifications' => $this->notifications->getUserNotifications('simple', 5)
        ]);
    }

    /**
     * Markeer alle notificaties als gelezen.
     *
     * @todo Implementatie phpunit tests
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAll(): RedirectResponse
    {
        $this->notifications->markAllAsRead();
        flash(trans('flash.notifications.mark-all'))->success()->important();

        return redirect()->route('notifications.index');
    }

    /**
     * Markeer een notificatie als gelezen in het systeem.
     *
     * @todo Implementatie phpunit tests
     *
     * @param  string $notification     De UUID van de notificatie in de databank.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markOne(string $notification): RedirectResponse
    {
        $notification = $this->notifications->findOrFail($notification);

        if ($notification->update(['read_at' => now()])) {
            flash(trans('flash.notifications.mark-one'))->success()->important();
        }

        return redirect()->route('notifications.index');
    }
}
