<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Http\Controllers\Controller;
use App\Repositories\CityRepository;
use App\Repositories\NotitionsRepository;
use App\Repositories\ProvinceRepository;
use App\Traits\ActivityLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;

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
    use ActivityLog;

    /**
     * @var ProvinceRepository $provinceRepository
     */
    private $provinceRepository;
    
    /**
     * @var CityRepository $cityRepository
     */
    private $cityRepository;

    /**
     * @var NotitionsRepository $notitionRepository
     */
    private $notitionRepository;

    /**
     * StadsMonitorConstructor
     *
     * @param  ProvinceRepository   $provinceRepository     Abstractie laag tussen controller, logica en database
     * @param  CityRepository       $cityRepository         Abstractie laag tussen controller, logica en database
     * @param  NotititionsRepoitory $NotitionsRepository    Abstractie laag tussen controller, logica en database
     * @return void
     */
    public function __construct(ProvinceRepository $provinceRepository, CityRepository $cityRepository, NotitionsRepository $notitionRepository)
    {
        parent::__construct();

        $this->middleware(['auth', 'forbid-banned-user']);

        $this->provinceRepository = $provinceRepository;
        $this->cityRepository     = $cityRepository;
        $this->notitionRepository = $notitionRepository;
    }

    /**
     * Cockpit voor de stads monitor.
     *
     * @todo Toevoegen van de paginatie section. (View)
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
     * Zoek een specifieke stad bij naam of postcode in het systeem.
     * 
     * @param  Request $input De ruwe invoer van de gebruiker.
     * @return \Illuminate\View 
     */
    public function search(Request $input) 
    {
        $input->validate(['term' => 'required']);

        $cities             = $this->cityRepository->searchCities($input->term, 20);
        $kernvrijeGemeentes = $this->cityRepository->count('kernwapen_vrij', true);

        return view('backend.stadsmonitor.index', compact('cities', 'kernvrijeGemeentes'));
    }

    /**
     * Wijzig een stad zijn status in de databank.
     *
     * @param  int  $city   De databank entiteit van de stad
     * @param  bool $status De door de gebruiker gegeven invoer.
     * @return RedirectResponse
     */
    public function kernwapenVrij(int $city, bool $status): RedirectResponse
    {
        $city = $this->cityRepository->findOrFail($city);

        if ($city->update(['kernwapen_vrij' => $status])) {
            $this->addActivity($city, 'Heeft de stad ' . $city->name . ' zijn status gewijzigd.');

            flash($this->cityRepository->determineFlashSession($status, $city))->info();
        }

        return redirect()->back(302);
    }

    /**
     * Wijzig een stad in de databank in de databank.
     *
     * @todo Registratie routering
     * @todo Registratie phpunit test
     * @todo Implementatie activity logger.
     *
     * @param  City $city   De databank entiteit van de stad.
     * @return RedirectResponse
     */
    public function update(City $city): RedirectResponse
    {
        if ($city->update($input->all())) {
            flash()->success("{$city->name} is aangepast in het systeem.");
        }

        return redirect()->route('admin->stadsmonitor.index');
    }

    /**
     * Geef een specifieke stad weer in de applicatie.
     *
     * @param  int $city De datacel van de stad in de databank.
     * @return View
     */
    public function show(int $city): View
    {
        $city = $this->cityRepository->with(['notitions.author'])->findOrFail($city);
        return view('backend.stadsmonitor.show', compact('city'));
    }
}
