<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ContactValidator;
use App\Mail\contactForm;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

/**
 * Class ContactController
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 <Tim Joosten>
 * @package App\Http\Controllers\Frontend
 */
class ContactController extends Controller
{
    /**
     * De index pagina voor het contact formulier.
     *
     * @return View
     */
    public function index(): View
    {
        return view('frontend.contact.index');
    }

    /**
     * Stuur het contact formulier naar de oragnisatie verantwoordelijke.
     *
     * @todo validation fails test
     * @todo validation success test
     *
     * @param  ContactValidator $input De gegeven gebruikers invoer (Gevalideerd)
     * @return RedirectResponse
     */
    public function send(ContactValidator $input): RedirectResponse
    {
        Mail::to(config('platform.contact_email'))->send(new contactForm($input->all()));
        flash(trans('flash.contact.send'))->success();

        return redirect()->route('contact.index');
    }
}
