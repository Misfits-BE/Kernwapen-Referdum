<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Permissie checks voor gebruiker gerelateerde zaken. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     \App\Policies
 */ 
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Policy om na te kijken of de aangemelde gebruiker niet dezelfde is dan gegeven gebruiker. 
     *
     * @param  \App\User  $user     De gebruikers entiteit vanuit de session.
     * @param  \App\User  $model    De gebruikers entiteit vanuit de databank. 
     * @return bool
     */
    public function sameUser(User $user, User $model): bool
    {
        return $user->id === $$model->id;
    }
}
