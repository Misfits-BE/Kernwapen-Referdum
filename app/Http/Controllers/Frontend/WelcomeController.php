<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * WelcomeController
 *
 * De controller die gebruikt word voor de index functions van de applicatie.
 *
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten
 */
class WelcomeController extends Controller
{
    /**
     * De frontend pagina met de uitleg van de petitie.
     *
     * @return View
     */
    public function index(): View
    {
        return view('frontend.welcome');
    }
}
