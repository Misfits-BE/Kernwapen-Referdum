<?php

namespace App\Http\Controllers\Backend;

use Gate;
use App\Notifications\ActiveUserNotification;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;

/**
 * BanController
 *
 * Controller voor het blokkeren en activeren van gebruikers.
 * In het systeem.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class BanController extends Controller
{
    use ActivityLog;

    /** @var \App\Repositories\UserRepository $userRepository */
    private $userRepository;

    /**
     * BanController constructor.
     *
     * @param  UserRepository $userRepository Abstractie laag tussen controller, logica, controller.
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->middleware(['auth', 'forbid-banned-user']);
        $this->userRepository = $userRepository;
    }

    /**
     * Blokkeer een login in het systeem.
     *
     * @param  int $user De gegeven gebruiker in de databank.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function lock(int $user): RedirectResponse
    {
        $user = $this->userRepository->findOrFail($user);

        if (Gate::allows('ban', $user)) { // De aangemelde gebruiker is niet dezelfde als de gegevn gebruiker.
            if ($user->isNotBanned() && $this->userRepository->lockUser($user)) {
                // 2de statement in de IF blokkeerd de gebruiker.
                flash("{$user->name} is geblokkeerd in the systeem.")->error();
                $this->addActivity($user, "Heeft {$user->name} geblokkeerd in het systeem");
            } else { // De gebruiker is al geblokkeerd in het systeem.
                flash("Helaas! Er is iets misgelopen. :(")->warning();
            }
        } else { // Aangemelde gebruiker is de zelfde als de gegeven gebruuiker. 
            flash('Er is iets misgelopen! Je kan namelijk jezelf niet blokkeren.')->warning()->important();
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Activeer een gebruiker in het systeem.
     * -------------------------------------------------------------------------
     * INFO: Het is niet nodig om hier te checken of de gebruiker in kwestie 
     *       Dezelfde is dan de aangemelde gebruiker. Want de routering is 
     *       Onbereikbaar voor geblokkeerde gebruikers.
     * -------------------------------------------------------------------------
     *
     * @param  int $user De gegeven gebruiker in de databank.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(int $user): RedirectResponse
    {
        $user = $this->userRepository->findOrFail($user);

        if ($user->isBanned()) {
            // 2de statement in de IF activeerd de gebruiker terug.
            flash("{$user->name} is terug actief in het systeem.")->success();

            $when = now()->addMinutes(1);
            $user->notify((new ActiveUserNotification())->delay($when));

            $this->userRepository->activateUser($user);
            $this->addActivity($user, "Heeft {$user->name} teruig geactiveerd het systeem.");


        } else { // De gebruiker is nog actief.
            flash("Helaas! Er is iets misgelopen. :(")->warning();
        }

        return redirect()->route('admin.users.index');
    }
}
