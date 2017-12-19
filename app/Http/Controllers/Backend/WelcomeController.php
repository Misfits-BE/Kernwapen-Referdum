<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

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
        $this->middleware('auth');
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
