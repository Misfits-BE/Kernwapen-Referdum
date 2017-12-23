<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SupportRepository;
use Illuminate\View\View;

/**
 * Support Controller 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class SupportController extends Controller
{
    /**
     * @var SupportRepository $supportRepository
     */
    private $supportRepository; 

    /**
     * SupportController constructor 
     * 
     * @param  SuppportRepository $supportRepository Abstractie laag tussen controller, logica, databank.
     * @return void
     */
    public function __construct(SupportRepository $supportRepository) 
    {
        $this->supportRepository = $supportRepository;
    }

    /**
     * De front-end index controller voor de ondersteunende organisatie(s).
     *
     * @todo Uitwerken van een phpunit test.
     * 
     * @return View
     */
    public function index(): View
    {
        return view('frontend.support.index', [
            'supports' => $this->supportRepository->listSupports(),
        ]);
    }
}
