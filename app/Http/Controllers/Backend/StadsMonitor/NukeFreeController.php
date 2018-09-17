<?php

namespace App\Http\Controllers\Backend\StadsMonitor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\City;

/**
 * Class NukeFreeController
 * 
 * @author      Tim Joosten <Tim@activisme.be>
 * @copyright   2018 Tim Joosten, Activisme_BE
 * @package     App\Http\Controllers\Backend\StadsMonitor
 */
class NukeFreeController extends Controller
{
    /**
     * NukeFreeController constructor 
     * 
     * @return void
     */
    public function __construct() 
    {
        $this->middleware(['auth', 'forbid-banned-user']);
    }

    /**
     * De functie voor het maken van een status update omtrent kernwapen vrij of niet. 
     * 
     * @param  City $city   De databank entiteit voor de gegeven stad. (findOrFail methode)
     * @param  bool $status De nieuwe status indicatie voor de gegeven stad.
     * @return View 
     */
    public function show(City $city, bool $status): View 
    {
        
    }
}
