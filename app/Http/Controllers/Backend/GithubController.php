<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\BugValidator;
use Github\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * GithubController
 *
 * Deze controller dient als brug tussen applicatie en github.
 * En geeft ook de mogelijkheid dat gebruikers vanuit de applicatie fouten kunnen melden.
 *
 * @author    Tim Joosten <tim@activisme.be>
 * @copyright 2018 Tim Joosten
 */
class GithubController extends Controller
{
    /**
     * GithubController constructor
     *
     * @param  Client $github De GitHub api client wrapper.
     * @return void
     */
    public function __construct(Client $github)
    {
        parent::__construct();

        $this->middleware(['auth', 'forbid-banned-user']);

        $github->authenticate(
            config('platform.github.username'),
            config('platform.github.password'),
            $github::AUTH_HTTP_PASSWORD
        );

        $this->github = $github;
    }


    /**
     * De creatie pagina voor een fout melding.
     *
     * @return View
     */
    public function create(): View
    {
        return view('backend.bugs.report', [
            'labels' => $this->github->api('issue')->labels()->all(
                config('platform.github.organization'),
                config('platform.github.repo-name')
            )
        ]);
    }

    /**
     * Opslag van het formulie in de GitHub Issue tracker.
     *
     * NOTE: Hier voorde functie is geen test nodig. WOrd al in de package gedaan.
     * We testen niet met de volgende redenen. Credentails komen openbaar in CI en
     * we willen geen repo vol met fake isses.
     *
     * @param  BugValidator $input de gegeven gebruikers invoer. (Gevalideerd.)
     * @return RedirectResponse
     */
    public function store(BugValidator $input): RedirectResponse
    {
        $githubBase = $this->github->api('issue'); // Basis instantie van de GitHub API Wrapper

        $create = $githubBase->create( // Slaag de foutmelding op (GitHub)
            config('platform.github.organization'), config('platform.github.repo-name'), [
                'title' => $input->titel, 'body' => $input->beschrijving
        ]);

        $attach = $githubBase->labels()->add( // Attach een labelaan het vooraf aangemaakte ticket.
            config('platform.github.organization'),
            config('platform.github.repo-name'),
            $create['number'],
            $input->label
        );

        if ($create && $attach) { // Ticket is aangemaakt en er is een label geattacheerd.
            flash(trans('bug.flash-create'))->success();
        }

        return redirect()->route('bug.create');
    }
}
