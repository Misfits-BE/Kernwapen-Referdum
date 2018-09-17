<?php 

return [

    /**
     *--------------------------------------------------------------------------
     * Flash Session Language Lines
     *--------------------------------------------------------------------------
     *
     * The following language lines are used by the flash Sessions to build
     * the simple flash session messages. You are free to change them to anything
     * you want to customize your views to better match your application.
     *
     */

    'ban' => [
        'user-blocked'   => ':name is geblokkeerd in de applicatie.',
        'user-unban'     => ':name is terug actief in het systeem.',
        'error'          => 'Helaas! Er is iets misgelopen. :(',
        'block-yourself' => 'Er is iets misgelopen! Je kan namelijk jezelf niet blokkeren.'
    ],
    
    'notifications' => [
        'mark-all' => 'Je hebt al je notificaties gelezen.',
        'mark-one' => 'Je hebt een notificatie als gelezen gemarkeerd.',
    ],

    'notitions' => [
        'store' => 'De notitie voor de stad :name is toegevoegd.',
        'delete' => 'De notitie is verwijderd.',
    ],

    'city-monitor' => [
        'nuclear-free-true' => ':name heeft zich kernwapen vrij verklaard.',
        'nuclear-free-false' => ':name heeft zich niet kernwapen vrij verklaard.',
        'nuclear-free-unknown' => 'kon niet uitmaken of de stad kernwapen vrij is of niet',
        
        'update' => ':name is aangepast in het systeem.',
    ],

    'support' => [
        'store' => 'De ondersteunende organisatie is toegevoegd aan het systeem.',
        'update' => 'De ondersteunende organisatàie is gewjzigd in het systeem.',
        'delete' => 'De ondersteunende organisatie is verwijderd.',
    ],

    'users' => [
        'store' => 'Er is een gebruiker aangemaakt voor :name',
        'update' => ':name is aangepast in het systeem.',
        'delete' => 'De gebruiker is verwijderd uit het systeem.',
    ],

    'contact' => [
        'send' => 'We hebben je email verzonden, en nemen spoedig contact met je op.',
    ]
];
