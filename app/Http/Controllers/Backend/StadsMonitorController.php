<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;
use App\Repositories\ProvinceRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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
        parent::__construct();

        $this->middleware(['auth', 'forbid-banned-user']);

        $this->provinceRepository = $provinceRepository;
        $this->cityRepository     = $cityRepository;
    }

    /**
     * Cockpit voor de stads monitor.
     *
     * @todo aanmaken view.
     * @todo phpunit
     *
     * @return View
     */
    public function index(): View
    {
        return view('backend.stadsmonitor.index', [
            'cities'             => $this->cityRepository->listCities(15),
            'kernvrijeGemeentes' => $this->cityRepository->count('kernwapen_vrij', 1)
        ]);
    }

    /**
     * Wijzig een stad in de databank.
     *
     * @todo implementatie phpunit
     * @todo implementatie activiteits logger.
     *
     * @param  int  $city   De databank entiteit van de stad
     * @param  bool $status De door de gebruiker gegeven invoer.
     * @return RedirectResponse
     */
    public function update(int $city, bool $status): RedirectResponse
    {
        $city = $this->cityRepository->findOrFail($city);

        if ($city->update(['kernwapen_vrij' => $status])) {
            $message = $this->cityRepository->determineFlashSession($status, $city);

            flash($message)->info();
        }

        return redirect()->route('admin.stadsmonitor.index');
    }

    /**
     * Geef een specifieke stad weer in de applicatie.
     *
     * @todo Implementeer phpunit test
     *
     * @param  int $city De datacel van de stad in de databank.
     * @return View
     */
    public function show(int $city): View
    {
        $city = $this->cityRepository->findOrFail($city);
        return view('backend.stadsmonitor.show', compact('city'));
    }
}
