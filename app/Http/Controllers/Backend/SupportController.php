<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\OrganizationValidator;
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
        $this->middleware(['auth']);
        $this->supportRepository  = $supportRepository;
    }

    /**
     * Index pagina voor de organisatie beheer.
     *
     * @todo uitschrijven phpunit test
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
     * Creatie weergave voor een nieuwe organisatie.
     *
     * @todo uitschrijven phpunit test.
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
     * @todo implementatie routering
     * @todo uitschrijven phpunit test.
     * @todo Trnaslatie flash message
     * @todo Implement activity logger.
     *
     * @param  OrganizationValidator $input De door de gebruiker gegeven invoer (Gevalideerd).
     * @return RedirectResponse
     */
    public function store(OrganizationValidator $input): RedirectResponse
    {
        if ($this->supportRepository->createOrganization($input->all())) {
            flash('De ondersteunende organisatie is toegevoegd aan het systeem.')->success();
        }

        return redirect()->route('admin.support.index');
    }

    /**
     * Verwijder een ondersteunende organisatie uit het systeem.
     *
     * @todo uitwerken van een phpunit test.
     *
     * @param  int $organisation De unieke waarde van de organisatie in de databank.
     * @return RedirectResponse
     */
    public function destroy(int $organisation): RedirectResponse
    {
        if ($this->supportRepository->deleteOrganisation($organisation)) {
            flash('De ondersteunende organisatie is verwijder.')->success();
        }

        return redirect()->route('admin.support.index');
    }
}
