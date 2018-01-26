<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Authorzitie checkvooor gebruikers handelingen in de applicatie. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright    Tim Joo sten 
 * @package      App\Policies
 */
class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user     De authenticatie entiteit van de aangemelde gebruiker. 
     * @param  \App\User  $model    De databank entiteit van de gegeven gebruiker. 
     * @return bool
     */
    public function ban(User $user, User $model): bool
    {
        return $user->id !== $model->id;
    }
}
