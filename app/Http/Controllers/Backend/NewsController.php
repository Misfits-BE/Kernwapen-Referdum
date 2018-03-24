<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Backend\ArticleStoreValidator;
use App\Http\Requests\Backend\ArticleUpdateValidator;

/**
 * Class NewsController 
 *  
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     App\Http\Controllers\Backend
 */
class NewsController extends Controller
{
    /** @var \App\Repositories\ArticleRepository $articleRepository */
    private $articleRepository; 

    /**
     * NewsController constructor
     * 
     * @param  ArticleRepository $articleRepository Abstractie laag tussen database en controller
     * @return void
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->middleware(['auth', 'forbid-banned-user']);
        $this->articleRepository = $articleRepository;
    }

    /**
     * De index pagina voor de beheersconsole van de nieuwsberichten. 
     * 
     * @todo opbouwen weergave
     * @todo opbouwen routering
     * @todo Implementatie phupunit test cases 
     * 
     * @return View
     */
    public function index(): View 
    {
        return view('backend.news.index', ['articles' => $this->articleRepository->paginateArticles(15)]);
    }

    /**
     * Create pagina voor een nieuwsbericht. 
     * 
     * @todo Implementatie phpunit tests
     * @todo Opbouwen weergave
     * @todo Implementate routering    
     * 
     * @return View
     */
    public function create(): View 
    {
        return view('backend.news.create');
    }

    /**
     * Slaag een nieuws artikel op in de database. 
     * 
     * @todo Registratie routering 
     * @todo Implementatie phpunit tests. 
     * @todo Opbouw van de validator
     * 
     * @param  ArticleStoreValidator $input De gegeven gebruikers invoer (gevalideerd).
     * @return Redirectresponse
     */
    public function store(ArticleStoreValidator $input): RedirectResponse 
    {
        if ($this->articleRepository->create($input->all())) {
            flash()->success();
        }

        return redirect()->route();
    }

    /**
     * Weergave voor het wijzigen van een nieuwsbericht. 
     * 
     * @todo Implementatie phpunit tests 
     * @todo Opbouwen van de weergave
     * @todo Implementatie van de routering. 
     * 
     * @param  string $article De unieke identificatie warde van het nieuws artikel. 
     * @return View 
     */
    public function edit(string $article): View 
    {
        return view('backend.news.edit', [
            'article' => $this->articleRepository->findArticle($article)
        ]);
    }

    /**
     * Wijzig een nieuws rtikel in de databank. 
     * 
     * @todo opbouwen validator 
     * @todo registratie routering 
     * @todo implementatie phpunit tests
     * @todo Opbouwen controller
     * 
     * @param  ArticleUpdateValidator   $input   De gegeven gebruiker incoer (Gevalideerd)
     * @param  string                   $article De unieke identicatie waarde in de databank.
     * @return RedirectResponse
     */
    public function update(ArticleUpdateValidator $input, string $article): RedirectResponse
    {
        //
    }

    /**
     * Methode voor het verwijderen van een nieuws artikel. 
     * 
     * @todo Implemen phpunit test 
     * @todo Registratie routering
     * 
     * @param  string $article De unieke identificatie waarde van het artikel in de databank.  
     * @return RedirectResponse
     */
    public function destroy(string $article): RedirectResponse
    {
        $article  = ''; 
        
        if ()
    }
}
