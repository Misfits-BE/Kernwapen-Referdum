<?php

namespace App\Policies;

use App\{User, City};
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Authorisatie checker voor de handelingen die gebeuren op steden in de stadsmonitor. 
 * 
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten, Activisme_BE
 * @package     App\Policies
 */
class CityPolicy
{
    use HandlesAuthorization;

    /**
     * Authorisatie check voor zeker te zijn dat de gegeven gemeente kernwapen vrij is. 
     * 
     * @param  User $user De databank entiteit van de aangemelde gebruiker. 
     * @param  City $city De gegeven databank entiteit van de gemeente.
     * @return bool 
     */
    public function kernwapenVrij(User $user, City $city): bool 
    {
        return $user->hasRole('admin') && (bool) $city->kernwapen_vrij;
    }
}
