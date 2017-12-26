<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\SignatureValidator;
use App\Repositories\SignatureRepository;
use Illuminate\Http\RedirectResponse;

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
     * @param  SignatureRepository $signatureRepository Abstractie laag tussen controller en model.
     * @return void
     */
    public function __construct(SignatureRepository $signatureRepository)
    {
        $this->signatureRepository = $signatureRepository;
    }

    /**
     * Slaag een handtekening op in het systeem.
     *
     * @todo uitwerken van een phpunit test.
     *
     * @param  SignatureValidator $input De gegeven gebruiker invoer. (Gevalideerd)
     * @return RedirectResponse
     */
    public function store(SignatureValidator $input): RedirectResponse
    {
        if ($person = $this->signatureRepository->createSignature($input->all())) {
            flash(trans('signature.flash-thank-you', [
                'firstname' => $person->voornaam, 'lastname' => $person->achternaam
            ]))->success();
        }

        return redirect()->route('frontend.index');
    }
}
