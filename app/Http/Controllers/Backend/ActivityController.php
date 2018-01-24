<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Http\Requests\Backend\ActivitySearchValidator;

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
     * @todo Implement phpunit (auth, no auth)
     * 
     * @param  ActivitySearchValidator $input De gegeven gebruiker invoer. (Gevalideerd)
     * @return \Illuminate\View\View
     */
    public function search(ActivitySearchValidator $input): View  
    {
        return view('backend.activity.index', [
            'activities' => $this->searchLogs($term, 'simple', 20)
        ]);
    }
}
