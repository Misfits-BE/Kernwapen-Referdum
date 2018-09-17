<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Notifications\ActiveUserNotification;
use App\Repositories\UserRepository;
use Gate;
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
                flash(trans('flash.ban.user-blocked', ['name' => $user->name]))->error();
                $this->addActivity($user, "Heeft {$user->name} geblokkeerd in het systeem");
            } else { // De gebruiker is al geblokkeerd in het systeem.
                flash(trans('flash.ban.error'))->warning();
            }
        } else { // Aangemelde gebruiker is de zelfde als de gegeven gebruuiker.
            flash(trans('flash.ban.block-yourself'))->warning()->important();
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
            flash(trans('flash.ban.user-unban', ['name' => $user->name]))->success();

            $when = now()->addMinutes(1);
            $user->notify((new ActiveUserNotification())->delay($when));

            $this->userRepository->activateUser($user);
            $this->addActivity($user, "Heeft {$user->name} terug geactiveerd het systeem.");
        } else { // De gebruiker is nog actief.
            flash(trans('flash.ban.error'))->warning();
        }

        return redirect()->route('admin.users.index');
    }
}
