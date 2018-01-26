<?php

namespace App\Http\Controllers\Frontend;

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
     * @param  SupportRepository $supportRepository Abstractie laag tussen controller, logica, databank.
     * @return void
     */
    public function __construct(SupportRepository $supportRepository)
    {
        parent::__construct();
        $this->supportRepository = $supportRepository;
    }

    /**
     * De front-end index controller voor de ondersteunende organisatie(s).
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
