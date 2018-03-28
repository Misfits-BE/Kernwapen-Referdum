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
     * @return View
     */
    public function index(): View
    {
        return view('backend.news.index', ['articles' => $this->articleRepository->paginateArticles(15)]);
    }

    /**
     * Create pagina voor een nieuwsbericht. 
     * 
     *! @todo Opbouwen weergave
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
        $article = $this->articleRepository->create($input->all());

        if ($article) {
            $this->addActivity($article, 'Heeft een nieuwsbericht aangemaakt.');
            flash("{$article->title} is aangemaakt als nieuwsbericht in het systeem.")->success();
        }

        return redirect()->route('admin.news.index');
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
     * 
     * @param  ArticleUpdateValidator   $input   De gegeven gebruiker incoer (Gevalideerd)
     * @param  string                   $article De unieke identicatie waarde in de databank.
     * @return RedirectResponse
     */
    public function update(ArticleUpdateValidator $input, string $article): RedirectResponse
    {
        $article = $this->articleRepository->findArticle($article); 

        if ($article->update($input->all())) {
            $this->addActivity($article, "Heeft het nieuwsbericht ({$article->title}) gewijzigd");
            flash("Het nieuwsbericht {$article->title} is gewijzigd")->success();
        }

        return redirect()->route('admin.news.index');
    }

    /**
     * Methode voor het verwijderen van een nieuws artikel. 
     * 
     * @todo Implement phpunit test 
     * @todo Registratie routering
     *
     * @param  string $article De unieke identificatie waarde van het artikel in de databank.
     * @return RedirectResponse
     */
    public function destroy(string $article): RedirectResponse
    {
        $article  = $this->articleRepository->findArticle($article);
        
        if ($article->delete()) {
            $this->addActivity($article, 'Heeft een artiàkel verwijderd in het systeem.');
        }

        return redirect()->route('admin.news.index');
    }
}
