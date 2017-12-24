<?php

namespace App\Http\Controllers\Backend;

use App\Repositories\ContactsRepository;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Backend\OrganizationValidator;
use App\Repositories\SupportRepository;
use App\Http\Controllers\Controller;

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
     * @var ContactsRepository $contactsRepository
     */
    private $contactsRepository;

    /**
     * SupportController Constructor 
     *
     * @param  SupportRepository  $supportRepository  abstractielaag tussen controller, logica, databank.
     * @param  ContactsRepository $contactsRepository abstractielaag tussen controller, logica, databank.
     * @return void 
     */
    public function __construct(SupportRepository $supportRepository, ContactsRepository $contactsRepository)
    {
        $this->middleware(['auth']);

        $this->supportRepository  = $supportRepository;
        $this->contactsRepository = $contactsRepository;
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
        $organizationCreate = $this->supportRepository->createOrganization($input->all());
        $contactsCreate     = $this->contactsRepository->createPerson($input->all());

        // Not stored in the organization table. Because we can have more that one 
        // Person as contact for the organisation. Think of big organisations like political parties.
        $attachContact      = $organizationCreate->contacts()->attach($contactsCreate->id);

        if ($organizationCreate && $contactsCreate && $attachContact) {
            flash('De ondersteunende organisatie is toegevoegd aan het systeem.')->success();
        }

        return redirect()->route('admin.support.index');
    }
}
