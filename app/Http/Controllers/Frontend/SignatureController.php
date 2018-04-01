<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
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
     * @param  CityRepository           $cityRepository      Abstractie laag tussen controller en model.
     * @param  NotificationRepository   $notitionsRepository Abstractie laag tussen controller en model.
     * @param  SignatureRepository      $signatureRepository Abstractie laag tussen controller en model.
     * @return void
     */
    public function __construct(
        CityRepository $cityRepository,
        SignatureRepository $signatureRepository, 
        NotificationRepository $notificationRepository
    ) {
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
            // Notificatie naar de gebruiker om te laten weten dat zijn email adres is gebruikt voor de petitie.
            $this->notificationRepository->sendSubscribeNotification($signature);

            // Check of de gegeven stad de nodige handtekeneningen heeft om een debat aan te vragen op de gemeenteraad
            if ($this->cityRepository->hasSpreakRight($input->postcode)) {
                // Stad heeft de nodig handtekeninhrn dus zend de notificatie naar alle administrators.
                $this->notificationRepository->sendSpeakRightNotification($input->postcode);
            }

            flash(trans('signature.flash-thank-you', [
                'firstname' => $signature->voornaam, 'lastname' => $signature->achternaam
            ]))->success();
        }

        return redirect()->route('frontend.index');
    }
    
    /**
     * Verwijder een handtekening uit het systeem. 
     * 
     * @todo Implementatie phpunit test 
     * 
     * @param  Request $input De instantie van de GET parameters
     * @return View|RedirectResponse
     */
    public function unsubscribe(Request $input)
    {
        if ($input->has('token') && $this->signatureRepository->deleteSignature($input->token)) {
            //! De token parameter is aanwezig en is verwijderd. 
            flash('Uw handtekening is verwijderd uit de applicatie.')->success()->important();
        } else { 
            //! De token parameter is leeg of de token is niet gevonden in het systeem. 
            flash('Wij konden de handtekening niet verwijderen. Wenst u toch vergeten te worden kunt u het contact formulier hanteren')
                ->warning()->important();
        }

        return redirect()->route('frontend.index');
    }
}
