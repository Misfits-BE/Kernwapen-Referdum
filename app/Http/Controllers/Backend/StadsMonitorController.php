<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\CityRepository; 
use App\Repositories\ProcinveRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Repositories\ProvinceRepository;

/**
 * StadsMonitor Controller 
 * 
 * De Stadsmonitor is een systeem. Dat alle informatie bundelt. Omtrent hoe een stad 
 * staat t.o.v Nukes en hun wapen technologie. 
 * 
 * @author    Tim Joosten <tim@activisme.be>
 * @copyright 2018 Tim Joosten
 */
class StadsMonitorController extends Controller
{
    /**
     * @var ProvinceRepository $provinceRepository
     */
    private $provinceRepository; 
    
    /**
     * @var CityRepository $cityRepository
     */
    private $cityRepository; 

    /**
     * StadsMonitorConstructor
     * 
     * @param  ProvinceRepository   $provinceRepository Abstractie laag tussen controller, logica en database
     * @param  CityRepository       $cityRepository     ABstractie laag tussen controller, logica en database
     * @return void
     */
    public function __construct(ProvinceRepository $provinceRepository, CityRepository $cityRepository) 
    {
        $this->middleware(['auth']);

        $this->provinceRepository = $provinceRepository; 
        $this->cityRepository     = $cityRepository;
    }

    /**
     * Cockpit voor de stads monitor. 
     * 
     * @todo aanmaken view.
     * @todo phpunit
     * @todo routering 
     * 
     * @return View 
     */
    public function index(): View
    {
        $cities = $this->cityRepository->listCities(15);

        return view('backend.stadsmonitor.index', compact('cities'));
    }
}
