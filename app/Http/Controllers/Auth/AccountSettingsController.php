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
 */
class AccountSettingsController extends Controller
{
    /**
     * @var UserRepository  $userRepository
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
     * @todo uitwerken phpunit test
     * @todo registreer routering
     *
     * @return View
     */
    public function index(): View
    {
        return view('auth.account-settings');
    }

    /**
     * @param  AccountInfoValidator $input
     * @return RedirectResponse
     */
    public function updateInformation(AccountInfoValidator $input): RedirectResponse
    {
        //
    }

    public function updateSecurity(AccountSecurityValidator $input): RedirectResponse
    {
        //
    }
}
