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
    ]

];