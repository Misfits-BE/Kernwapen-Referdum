<?php

namespace App\Policies;

use App\User;
use App\City;
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
     * Check dat een gemeente als kernwapen vrij verklaard staat geregistreerd. 
     * 
     * @param  City $city   De databank entity van de stad. 
     * @param  bool $status De status indicater die gegeven word door de gebruiker
     * @return bool
     */
    public function isKernwapenVrij(City $city, bool $status): bool 
    {
        return $city->kernwapen_vrij === $status; 
    }
}
