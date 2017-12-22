<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * UsersController
 *
 * Controller met beheers functie die een betrekking hebben.
 * Tot het wijzigen, toevoegen van gebruikers.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class UsersController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * @var RoleRepository $roleRepository
     */
    private $roleRepository;

    /**
     * UsersController constructor.
     *
     * @param  UserRepository $userRepository Abstractie laag tussen logica, controller en database.
     * @param  RoleRepository $roleRepository Abstractie laag tussen logica, controller en database.
     * @return void
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->middleware(['auth']);

        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * De beheers console voor de gebruikers.
     *
     * @todo write phpunit test.
     *
     * @return View
     */
    public function index(): View
    {
        return view('backend.users.index', [
            'users' => $this->userRepository->paginateUsers(20, 'simple')
        ]);
    }

    /**
     * De creatie weergave voor een nieuwe gebruiker.
     *
     * @todo write phpunit test
     * @todo opbouwen van weergave
     * @todo registratie routering.
     *
     * @return View
     */
    public function create(): View
    {
        return view('backend.users.create', [
            'roles' => $this->roleRepository->listRoles(['id', 'name'])
        ]);
    }

    /**
     * Verwijder een gebruiker uit het systeem.
     *
     * @todo creatie phpunit test
     * @todo implementatie activiteiten logger
     *
     * @param  int $user De gegeven gebruiker in het systeem.
     * @return RedirectResponse
     */
    public function destroy(int $user): RedirectResponse
    {
        if ($this->userRepository->deleteUser($user)) {
            flash("De gebruiker is verwijderd uit het systeem.")->success();
        }

        return redirect()->route('admin.users.index');
    }
}
