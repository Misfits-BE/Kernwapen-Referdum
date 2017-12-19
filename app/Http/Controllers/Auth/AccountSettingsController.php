<?php

namespace App\Http\Controllers\Auth;

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
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
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

    public function updateInformation(): RedirectResponse
    {
        //
    }

    public function updateSecurity(): RedirectResponse
    {
        //
    }
}
