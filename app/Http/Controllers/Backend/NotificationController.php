<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAll(): RedirectResponse
    {
        $this->notifications->markAllAsRead();
        flash('Je hebt al je notificaties gelezen.')->success()->important();

        return redirect()->route('notifications.index');
    }

    /**
     * Markeer een notificatie als gelezen in het systeem.
     * 
     * @param  string $notification     De UUID van de notificatie in de databank.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markOne(string $notification): RedirectResponse  
    {
        $notification = $this->notifications->findOrFail($notification); 

        if ($notification->update(['read_at' => now()])) {
            flash('Je hebt een notificatie als gelezen gemarkeerd.')->success()->important();
        }

        return redirect()->route('notifications.index');
    }
}
