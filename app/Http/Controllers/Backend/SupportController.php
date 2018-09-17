<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\OrganizationUpdateValidator;
use App\Http\Requests\Backend\OrganizationValidator;
use App\Http\Requests\Backend\SearchValidator;
use App\Repositories\SupportRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * SupportController
 *
 * De controller voor het beheer van de ondersteunende organisaties.
 *
 * @author    Tim Joosten <tim@activisme.be>
 * @copyright 2018 Tim Joosten
 */
class SupportController extends Controller
{
    /**
     * @var SupportRepository $supportRepository;
     */
    private $supportRepository;

    /**
     * SupportController Constructor
     *
     * @param  SupportRepository  $supportRepository  abstractielaag tussen controller, logica, databank.
     * @return void
     */
    public function __construct(SupportRepository $supportRepository)
    {
        parent::__construct();

        $this->middleware(['auth', 'forbid-banned-user']);
        $this->supportRepository  = $supportRepository;
    }

    /**
     * Index pagina voor de organisatie beheer.
     *
     * @return view
     */
    public function index(): View
    {
        return view('backend.support.index', [
            'organizations' => $this->supportRepository->paginateOrgs(15, 'simple')
        ]);
    }

    /**
     * Zoek voor een speicifieke ondersteunende organisatie.
     *
     * @todo Implementatie IF/ELSE wanneer er meer dan 12 organisaties zijn. (view)
     * @todo Implement phpunit test (auth, no auth, forbid-banned-user)
     *
     * @param  SearchValidator $input De gegeven gebruikersinvoer (Gevalideerd)
     * @return \Illuminate\View\View
     */
    public function search(SearchValidator $input): View
    {
        return view('backend.support.index', [
            'organizations' => $this->supportRepository->searchOrganization($input->term, 15)
        ]);
    }

    /**
     * Creatie weergave voor een nieuwe organisatie.
     *
     * @return View
     */
    public function create(): View
    {
        return view('backend.support.create');
    }

    /**
     * Sla de ondersteunende organisatie op in de databanK.
     *
     * @todo Translatie flash message
     *
     * @param  OrganizationValidator $input De door de gebruiker gegeven invoer (Gevalideerd).
     * @return RedirectResponse
     */
    public function store(OrganizationValidator $input): RedirectResponse
    {
        $organisation = $this->supportRepository->createOrganization($input->all());

        if ($organisation) {
            $this->addActivity($organisation, 'Heeft een ondersteunende organisatie toegevoegd.');
            flash(trans('flash.support.store'))->success();
        }

        return redirect()->route('admin.support.index');
    }

    /**
     * Weergave voor het wijzigen van een ondersteundende organisatie in het systeem.
     *
     * @todo implementatie phpunit test
     *
     * @param   int $organisation   The unieke identificatie van de organisatie in het systeem.
     * @return \Illuminate\View\View
     */
    public function edit(int $organisation): View
    {
        return view('backend.support.edit', [
            'organisation' => $this->supportRepository->findOrFail($organisation)
        ]);
    }

    /**
     * Update de ondersteunende organisatie in de databank.
     *
     * @todo Implementatie phpunit test
     *
     * @param  OrganizationUpdateValidator $input           De gegeven gebruikers invoer (gevalideerd).
     * @param  int                         $organisation    De unieke identificatie van de organisatie
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(OrganizationUpdateValidator $input, int $organisation): RedirectResponse
    {
        $organisation = $this->supportRepository->findOrFail($organisation);

        if ($organisation->update($input->except('_token', '_method'))) {
            $this->addActivity($organisation, 'Heeft een ondersteunende organisatie gewijzigd.');
            flash(trans('flash.support.update'))->success();
        }

        return redirect()->route('admin.support.index');
    }

    /**
     * Verwijder een ondersteunende organisatie uit het systeem.
     *
     * @param  int $organisation De unieke waarde van de organisatie in de databank.
     * @return RedirectResponse
     */
    public function destroy(int $organisation): RedirectResponse
    {
        $organisation = $this->supportRepository->findOrFail($organisation);

        if ($organisation->delete()) {
            $this->addActivity($organisation, 'Heeft een ondersteunende organisatie verwijderd');
            flash(trans('flash.support.delete'))->success();
        }

        return redirect()->route('admin.support.index');
    }
}
