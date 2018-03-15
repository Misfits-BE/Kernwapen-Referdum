<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserValidator;
use App\Notifications\CredentialsNotification;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Traits\ActivityLog;
use App\User;
use Illuminate\Http\RedirectResponse;
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
    use ActivityLog;

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
        parent::__construct();

        $this->middleware(['auth', 'forbid-banned-user']);

        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * De beheers console voor de gebruikers.
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
     * @return View
     */
    public function create(): View
    {
        return view('backend.users.create', [
            'roles' => $this->roleRepository->listRoles(['id', 'name'])
        ]);
    }

    /**
     * Creer een nieuw login in het systeem. Op basis van de gebruikers invoer.
     *
     * @todo implementatie phpunit test (forbid-banned-user, 'auth', 'no auth')
     *
     * @param  UserValidator $input De gegeven gebruikers invoer (Gevalideerd).
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserValidator $input): RedirectResponse
    {
        $password = str_random(16);
        $sendAt   = now()->addMinute();

        $input->merge(['password' => $password]);

        if ($user = $this->userRepository->createUser($input->except('_token', 'role'), $input->role)) {
            $user->notify((new CredentialsNotification($user, $password))->delay($sendAt));
            $this->addActivity($user, 'Heeft een login aangemaakt in het systeem.');

            flash(trans('flash.users.store', ['name' => $user->name]))->success()->important();
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Weergave formulier om een gebruiker te wijzigen.
     *
     * @param  int $user De unieke gebruikers waarde in de databank
     * @return View
     */
    public function edit(int $user): View
    {
        return view('backend.users.edit', [
            'user'  => $this->userRepository->findOrFail($user),
            'roles' => $this->roleRepository->listRoles(['id', 'name'])
        ]);
    }

    /**
     * Wijzig een gebruiker in de databank.
     *
     * @todo Implementatie routering
     * @todo uitwerken phpunit test
     * @todo Koppelen aan de weergave
     *
     * @param  User          $user  De gebruiker in de databank.
     * @param  UserValidator $input De door de gebruiker gebruiker gegeven invoer.
     * @return RedirectResponse
     */
    public function update(User $user, UserValidator $input): RedirectResponse
    {
        if ($user->update($input->all())) {
            $user->syncRoles($input->roles);

            $this->roleRepository->apiAccess($user, $input->api_access);
            $this->addActivity($user, 'Heeft een gebruikers account gewijzigd');

            flash(trans('flash.users.update', ['name' => $user->name]))->success();
        }

        return redirect()->route('admin.users.index');
    }

    /**
     * Verwijder een gebruiker uit het systeem.
     *
     * @param  int $user De gegeven gebruiker in het systeem.
     * @return RedirectResponse
     */
    public function destroy(int $user): RedirectResponse
    {
        $user = $this->userRepository->findOrFail($user);

        if ($user->delete()) {
            $this->addActivity($user, 'Heeft een gebruiker verwijderd uit het systeem.');
            flash(trans('flash.users.delete'))->success();
        }

        return redirect()->route('admin.users.index');
    }
}
