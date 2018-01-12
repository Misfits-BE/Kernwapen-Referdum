<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ActivityLog;
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
    use ActivityLog; 

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
     * @todo Implementatie test (auth, forbid-banned-user)
     * 
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('backend.activity.index', ['activities' => $this->getLogs('simple', 20)]); 
    }
}
