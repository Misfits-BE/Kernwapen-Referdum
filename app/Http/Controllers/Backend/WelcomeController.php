<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * WelcomeController
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class WelcomeController extends Controller
{
    /**
     * WelcomeController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * Index dashboard voor de admin sectie.
     *
     * @return View
     */
    public function index(): View
    {
        return view('backend.welcome');
    }
}
