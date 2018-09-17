<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\SignatureValidator;
use App\Repositories\CityRepository;
use App\Repositories\NotificationRepository;
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
    /** @var \App\Repositories\SignatureRepository $signatureRepository */
    private $signatureRepository;

    /** @var \App\Repositories\NotificationRepository $notificationRepository */
    private $notificationRepository;

    /** @var \App\Repositories\CityRepository $cityRepository */
    private $cityRepository;

    /**
     * SignatureController constructor.
     *
     * @param  NotificationRepository   $notitionsRepository Abstractie laag tussen controller en model.
     * @param  CityRepository           $cityRepository      Abstractie laag tussen controller en model.
     * @param  SignatureRepository      $signatureRepository Abstractie laag tussen controller en model.
     * @return void
     */
    public function __construct(SignatureRepository $signatureRepository, NotificationRepository $notificationRepository, CityRepository $cityRepository)
    {
        parent::__construct();

        $this->signatureRepository    = $signatureRepository;
        $this->notificationRepository = $notificationRepository;
        $this->cityRepository         = $cityRepository;
    }

    /**
     * Slaag een handtekening op in het systeem.
     *
     * @todo Implementatie notificatie wanneer een stad de limiet voor spreekrecht bereikt.
     * @todo Als gemeeente het aantal voor spreekrecht bereikt moet er een notificatie gestuurd worden.
     *
     * @param  SignatureValidator $input De gegeven gebruiker invoer. (Gevalideerd)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SignatureValidator $input): RedirectResponse
    {
        if ($signature = $this->signatureRepository->createSignature($input->all())) {
            if ($this->cityRepository->hasSpreakRight($input->postcode)) {
                $this->notificationRepository->sendSpeakRightNotification($input->postcode);
            }

            flash(trans('signature.flash-thank-you', [
                'firstname' => $signature->voornaam, 'lastname' => $signature->achternaam
            ]))->success();
        }

        return redirect()->route('frontend.index');
    }
}
