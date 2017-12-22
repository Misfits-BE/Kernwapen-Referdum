<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\AccountInfoValidator;
use App\Http\Requests\Auth\AccountSecurityValidator;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * AccountSettingsController
 *
 * De controller voor de account configuratie.
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class AccountSettingsController extends Controller
{
    /**
     * @var UserRepository $userRepository
     */
    private $userRepository;

    /**
     * AccountSettingsController constructor
     * .
     * @param  UserRepository $userRepository Abstractie laag tussen controller en model.
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(['auth']);
        $this->userRepository = $userRepository;
    }

    /**
     * Index paneel voor de account configuratie.
     *
     * @return View
     */
    public function index(): View
    {
        return view('auth.account-settings', ['user' => $this->userRepository->getUser()]);
    }

    /**
     * Pas de account informatie aan in de databank.
     * 
     * @param  AccountInfoValidator $input De gegeven gebruikers invoer (Gevalideerd)
     * @return RedirectResponse
     */
    public function updateInformation(AccountInfoValidator $input): RedirectResponse
    {
        if ($this->userRepository->updateUser($input->except('_token', '_method'))) {
            flash(trans('user.flash-update-information'))->success();
        }

        return redirect()->route('account.settings', ['type' => 'informatie']);
    }

    /**
     * Pas de account beveiliging aan in de databank.
     * 
     * @param  AccountSecurityValidator $input De gegeven gebruikers invoer (Gevalideerd)
     * @return RedirectResponse
     */
    public function updateSecurity(AccountSecurityValidator $input): RedirectResponse
    {
        $input = $input->except('_token', '_method', 'password_confirmation');

        if ($this->userRepository->updateUser($input)) {
            flash(trans('user.flash-update-security'))->success();
        }

        return redirect()->route('account.settings', ['type' => 'beveiliging']);
    }
}
