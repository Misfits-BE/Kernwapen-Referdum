<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

/**
 * Disclaimer controller.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 */
class DisclaimerController extends Controller
{
    /**
     * Weergeve van de applicatie disclaimer.
     *
     * @return View
     */
    public function index(): View
    {
        return view('frontend.disclaimer.index');
    }
}
