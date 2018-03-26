<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;

/**
 * Class NewsController 
 * ---- 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten 
 * @package     App\Http\Controllers\Frontend
 */
class NewsController extends Controller
{
    /** @var \App\Repositories\ArticleRepository $articleRespository */
    private $articleRespository;

    /**
     * NewsController constructor
     * 
     * @param  ArticleRepository $articleRespository Abstractie laag tussen database en controller.
     * @return void
     */
    public function __construct(ArticleRepository $articleRespository)
    {
        $this->articleRespository = $articleRespository;
    }

    /**
     * Haal de front-end index page op voor de nieuwsberichten. 
     * 
     * @todo build up the view 
     * 
     * @return View
     */
    public function index(): View 
    {
        return view('frontend.news.index', ['articles' => $this->articleRespository->paginateArticles(7)]); 
    }

    /**
     * pagina voor een specifiek nieuwsbericht in het systeem. 
     * 
     * @todo Opbouwen weergave
     * @todo Implementatie social media (OpenGraph, Twitter cards)
     * 
     * @param  string $slug De unieke identificatie waarde van het nieuwsbericht in de databank.
     * @return View
     */
    public function show(string $slug): View 
    {
        $article = $this->articleRespository->findArticle($slug);
        return view('frontend.news.show', compact('article'));
    }
}
