<?php

namespace App\Http\Controllers\Backend;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\ArticleStoreValidator;
use App\Http\Requests\Backend\ArticleUpdateValidator;
use App\Repositories\Criteria\Articles\SearchCriteria;

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
     * @param  Request $input The instance for getting the data from the search form.
     * @return View
     */
    public function index(Request $input): View
    {
        if ($input->has('term')) { //! There is term data found from the form. If not skip this part.
            $baseQuery = $this->articleRepository->pushCriteria(new SearchCriteria('titel', $input->term));

            if ($baseQuery->entity()->count() > 0) { //! There are records found in the search query
                return view('backend.news.index', ['articles' => $this->articleRepository->simplePaginate(15)]);
            }
        }

        return view('backend.news.index', ['articles' => $this->articleRepository->paginateArticles(15)]);
    }

    /**
     * Creatie pagina voor een nieuwsbericht. 
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
     * @param  ArticleStoreValidator $input De gegeven gebruikers invoer (gevalideerd).
     * @return Redirectresponse
     */
    public function store(ArticleStoreValidator $input): RedirectResponse
    {
        $input->merge(['author_id' => $input->user()->id]); 
        $article = $this->articleRepository->create($input->all());

        if ($article) {
            $this->addActivity($article, 'Heeft een nieuwsbericht aangemaakt.');
            flash("{$article->titel} is aangemaakt als nieuwsbericht in het systeem.")->success();
        }

        return redirect()->route('admin.news.index');
    }

    /**
     * Weergave voor het wijzigen van een nieuwsbericht.
     *
     * @todo Opbouwen van de weergave
     *
     * @param  string $article De unieke identificatie warde van het nieuws artikel.
     * @return View
     */
    public function edit(string $article): View
    {
        return view('backend.news.edit', ['article' => $this->articleRepository->findArticle($article)]);
    }

    /**
     * Wijzig een nieuws rtikel in de databank.
     *
     * @todo opbouwen validator             -> DONE
     * @todo registratie routering          -> DONE (route: admin.news.update)
     * @todo implementatie phpunit tests    -> DONE
     * @todo Opbouwen van de weergave
     * 
     * @param  ArticleUpdateValidator   $input   De gegeven gebruiker incoer (Gevalideerd)
     * @param  string                   $article De unieke identicatie waarde in de databank.
     * @return RedirectResponse
     */
    public function update(ArticleUpdateValidator $input, string $article): RedirectResponse
    {
        $article = $this->articleRepository->findArticle($article); 

        if ($article->update($input->all())) {
            $this->addActivity($article, "Heeft het nieuwsbericht ({$article->titel}) is gewijzigd.");
            flash("Het nieuwsbericht {$article->titel} is gewijzigd.")->success();
        }

        return redirect()->route('admin.news.index');
    }

    /**
     * Methode voor het verwijderen van een nieuws artikel. 
     *
     * @param  string $article De unieke identificatie waarde van het artikel in de databank.
     * @return RedirectResponse
     */
    public function destroy(string $article): RedirectResponse
    {
        $article  = $this->articleRepository->findArticle($article);
        
        if ($article->delete()) {
            flash('Het nieuwsbericht ' . $article->titel . ' is verwijderd uit de applicatie')->info()->important();
            $this->addActivity($article, 'Heeft een artikel verwijderd in het systeem.');
        }

        return redirect()->route('admin.news.index');
    }
}
