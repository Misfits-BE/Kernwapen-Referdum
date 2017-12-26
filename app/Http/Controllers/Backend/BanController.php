<?php

namespace App\Http\Controllers\Backend;

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
    /**
     * @var UserRepository $userRepository
     */
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
     * @todo Implementeer phpunit test
     * @todo Implementeer activiteits logger
     *
     * @param  int $user De gegeven gebruiker in de databank.
     * @return RedirectResponse
     */
    public function lock(int $user): RedirectResponse
    {
        $user = $this->userRepository->findOrFail($user);

        if ($user->isNotBanned() && $this->userRepository->lockUser($user)) {
            // 2de statement in de IF blokkeerd de gebruiker.
            flash("{$user->name} is geblokkeerd in the systeem.")->error();
        } else { // De gebruiker is al geblokkeerd in het systeem.
            flash("Helaas! Er is iets misgelopen. :(")->warning();
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Activeer een gebruiker in het systeem.
     *
     * @todo Implementeer phpunit test
     * @todo Implementeer activiteits logger
     *
     * @param  int $user De gegeven gebruiker in de databank.
     * @return RedirectResponse
     */
    public function destroy(int $user): RedirectResponse
    {
        $user = $this->userRepository->findOrFail($user);

        if ($user->isBanned() && $this->userRepository->activateUser($user)) {
            // 2de statement in de IF activeerd de gebruiker terug.
            flash("{$user->name} is terug actief in het systeem.")->success();
        } else { // De gebruiker is nog actief.
            flash("Helaas! Er is iets misgelopen. :(")->warning();
        }
    }
}
