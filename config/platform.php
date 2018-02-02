<?php

return [

    /**
     * --------------------------------------------------------------------------
     * Author config
     * --------------------------------------------------------------------------
     *
     * De data omtrent de organisatie of persoon dat verantwoordelijk is
     * voor het platform.
     *
     */

    'author' => [
        'name'    => 'Activisme_be',
        'website' => 'https://www.activisme.be',
        'email'   => 'acties@activisme.be'
    ],

    /**
     * --------------------------------------------------------------------------
     * Social media config
     * --------------------------------------------------------------------------
     *
     * De nodige configuratie om ook zichtbaar te zijn op de sociale media
     * (facebook, twitter)
     *
     */

    'social' => [
        'link'  => config('app.url'),
        'title' => 'Belgie verban de kernwapens!'
    ],

    /**
     * --------------------------------------------------------------------------
     * Github credentails config
     * --------------------------------------------------------------------------
     *
     * De nodige configuratie is nodig voor de brug tussen Github en de applicatie.
     *
     */
    
    'github' => [
        'username'     => env('GITHUB_USERNAME', 'username'),
        'password'     => env('GITHUB_PASSWORD', 'password'),
        'organization' => 'Misfits-BE',
        'repo-name'    => 'Kernwapen-Referendum',
    ],

    /**
     * ---------------------------------------------------------------------------
     * Contact information.
     * ---------------------------------------------------------------------------
     *
     * ['contact_email'] = De nodige configuratie voor het verzenden van het contact formulier.
     *
     */
    'contact_email' => 'info@activisme.be',

    /**
     * ---------------------------------------------------------------------------
     * Aantal spreekrecht
     * ---------------------------------------------------------------------------
     * 
     * Het aantal nodige handtekeningen dat nodig is voor speekrecht te krijgen in een gemeenteraad.
     * 
     */
    'amount_speakRight' => 1,
];
