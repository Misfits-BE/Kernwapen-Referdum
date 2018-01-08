<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
}
