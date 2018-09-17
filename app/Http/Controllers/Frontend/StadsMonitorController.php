<?php

namespace App\Http\Controllers\Frontend;

use App\City;
use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;
use Illuminate\Http\Request;
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
     * @return View
     */
    public function index(): View
    {
        return view('frontend.stadsmonitor.index', [
            'cities'  => $this->cityRepository->listCities(20),
            'counter' => $this->cityRepository->count('kernwapen_vrij', true)
        ]);
    }

    /**
     * Zoek voor een specifieke stad in het systeem.
     *
     * @param  Request $input
     * @return View
     */
    public function search(Request $input): View
    {
        $input->validate(['term' => 'required']);

        $cities  = $this->cityRepository->searchCities($input->term, 20);
        $counter = $this->cityRepository->count('kernwapen_vrij', true);

        return view('frontend.stadsmonitor.index', compact('counter', 'cities'));
    }

    /**
     * Displsay een specifiekoe stad inj de stads monitor.
     *
     * @return View
     */
    public function show(string $city): View
    {
        return view('frontend.stadsmonitor.show', [
            'city' => $this->cityRepository->findCity($city),
        ]);
    }
}
