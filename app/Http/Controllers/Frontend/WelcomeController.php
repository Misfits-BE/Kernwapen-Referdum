<?php

namespace App\Http\Controllers\Frontend;

use App\Repositories\SignatureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * WelcomeController
 *
 * De controller die gebruikt word voor de index functions van de applicatie.
 *
 * @author      Tim Joosten <tim@ctivisme.be>
 * @copyright   2018 Tim Joosten
 */
class WelcomeController extends Controller
{
    /**
     * @var SignatureRepository $signatureRepository
     */
    private $signatureRepository;

    /**
     * WelcomeController constructor.
     *
     * @param  SignatureRepository $signatureRepository Abstractie laag tussen controller en model.
     * @return void
     */
    public function __construct(SignatureRepository $signatureRepository)
    {
        $this->signatureRepository = $signatureRepository;
    }

    /**
     * De frontend pagina met de uitleg van de petitie.
     *
     * @return View
     */
    public function index(): View
    {
        return view('frontend.welcome', [
            'signatures' => $this->signatureRepository->countSignatures()
        ]);
    }
}
