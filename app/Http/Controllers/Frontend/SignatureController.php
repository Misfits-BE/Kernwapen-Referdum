<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Requests\Shared\SignatureValidator;
use App\Repositories\SignatureRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * SignatureController
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class SignatureController extends Controller
{
    /**
     * @var SignatureRepository $signatureRepository
     */
    private $signatureRepository;

    /**
     * SignatureController constructor.
     *
     * @param  SignatureRepository $signatureRepository
     * @return void
     */
    public function __construct(SignatureRepository $signatureRepository)
    {
        $this->signatureRepository = $signatureRepository;
    }

    /**
     * Slaag een handtekening op in het systeem.
     *
     * @todo implementatie routering
     * @todo uitwerken van een phpunit test.
     *
     * @param  SignatureValidator $input De gegeven gebruiker invoer. (Gevalideerd)
     * @return RedirectResponse
     */
    public function store(SignatureValidator $input): RedirectResponse
    {
        dd($input->all());
    }
}
