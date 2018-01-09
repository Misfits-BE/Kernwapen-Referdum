<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;
use Illuminate\View\View;

/**
 * Class StadsMonitorController
 *
 * De front-end controller voor de stadsmonitor.
 * In deze controller komt alle stads data zichtbaar voor een gebruiker.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     App\Http\Controllers\Frontend
 */
class StadsMonitorController extends Controller
{
    /**
     * @var CityRepository $cityRepository
     */
    private $cityRepository;

    /**
     * StadsMonitorController constructor.
     *
     * @param  CityRepository $cityRepository De abstractie laag tussen logica, controller en databank.
     * @return void
     */
    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    /**
     * De index pagina voor de stadsmonitor weergave.
     *
     * @todo Uitwerken phpunit test
     *
     * @return View
     */
    public function index(): View
    {
        return view('frontend.stadsmonitor.index', [
            'cities'  => $this->cityRepository->listCities(20),
            'counter' => $this->cityRepository->countKernVrij()
        ]);
    }
}
