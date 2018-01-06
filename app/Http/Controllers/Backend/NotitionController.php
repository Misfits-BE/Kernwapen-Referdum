<?php

namespace App\Http\Controllers\Backend;

use App\City;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\NotitionValidator;
use App\Notitions;
use App\Repositories\CityRepository;
use App\Repositories\NotitionsRepository;
use App\Traits\ActivityLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * NotitionController
 *
 * Notitie controller voor het beheer van notities per stad in de stads monitor.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class NotitionController extends Controller
{
    use ActivityLog;

    /**
     * @var CityRepository $cityRepository
     */
    private $cityRepository;

    /**
     * @var NotitionsRepository $notitionRepository
     */
    private $notitionRepository;

    /**
     * NotitionController constructor
     *
     * @param  CityRepository $cityRepository The abstractie laag tussen logica, databank en controller.
     * @return void
     */
    public function __construct(CityRepository $cityRepository, NotitionsRepository $notitionRepository)
    {
        parent::__construct();

        $this->middleware(['auth', 'forbid-banned-user']);

        $this->cityRepository     = $cityRepository;
        $this->notitionRepository = $notitionRepository;
    }

    /**
     * Het creatie formulier voor een notitie.
     *
     * @param  int $city De unieke waarde van de stad in de databank.
     * @return View
     */
    public function create(int $city): View
    {
        $city = $this->cityRepository->findOrFail($city);

        return view('backend.notitions.create', compact('city'));
    }

    /**
     * Slaag een notitie op Op basis van de gegeven stad.
     *
     * @param  NotitionValidator $input De gegeven gebruikers invoer data. (Gevalideerd)
     * @param  int               $city  De gegeven databank entiteit van de stad.
     * @return RedirectResponse
     */
    public function store(NotitionValidator $input, int $city): RedirectResponse
    {
        $city     = $this->cityRepository->findOrFail($city);
        $notition = $this->notitionRepository->prepHasMany($input);

        if ($city->notitions()->save($notition)) {
            flash("De notitie voor de stad '{$city->name}' is toegevoegd.")->success();
            $this->addActivity($city, "heeft een notitie toegevoegd voor de stad {$city->name}");
        }

        return redirect()->route('admin.stadsmonitor.show', $city);
    }


    /**
     * Verwijder een notitie van een stad uit de databank.
     *
     * @param  Notitions $notition De databank entiteit van de notitie.
     * @param  City      $city     De databank entiteit van de stad.
     *
     * @throws \Exception
     *
     * @return RedirectResponse
     */
    public function destroy(Notitions $notition, City $city): RedirectResponse
    {
        if ($notition->delete()) {
            flash("De notitie is verwijderd.")->success();
            $this->addActivity($city, 'Heeft een notitie verwijderd voor de stad ' . $city->name);
        }

        return redirect()->route('admin.stadsmonitor.show', $city);
    }
}
