<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ActivitySearchValidator;
use Illuminate\View\View;

/**
 * Class ActivityController
 *
 * De controller voor alle gelogde gebruiker activiteit in de backend.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class ActivityController extends Controller
{
    /**
     * ActivityController Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * Methode voor de oplijsting van alle activiteit die gelogd is in de applicatie.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.activity.index', ['activities' => $this->getLogs('simple', 20)]);
    }

    /**
     * Zoek een specifiek activeits log in de databank opslag.
     *
     * @todo Implement phpunit (auth, no auth, blocked user)
     *
     * @todo Refactor ActivitySearchValidator to the Search validator.
     *       Because multiple system have a search and te term is always called 'term'.
     *
     * @param  ActivitySearchValidator $input De gegeven gebruiker invoer. (Gevalideerd)
     * @return \Illuminate\View\View
     */
    public function search(ActivitySearchValidator $input): View
    {
        return view('backend.activity.index', [
            'activities' => $this->searchLogs($input->term, 'simple', 20)
        ]);
    }
}
