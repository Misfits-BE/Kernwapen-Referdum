<?php

namespace App\Policies;

use App\User;
use Misfits\ApiGuard\Models\ApiKey;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class ApiTokenPolicy
 * ----
 * Authorisatie controle voor de API tokens in de applicatie.
 *
 * @author      Tim Joosten <tim@activisme.be>
 * @copyright   2018 Tim Joosten
 * @package     App\Policies
 */
class ApiTokenPolicy
{
    use HandlesAuthorization;

    /**
     * Authorisatie check voor het verwijderen van een API Token
     *
     * @param  User   $user     De databank entiteit van de aangemelde gebruiker.
     * @param  ApiKey $model    De databank entiteit van de API token.
     * @return bool
     */
    public function deleteToken(User $user, ApiKey $model): bool
    {
        return $user->id === $model->apikeyable_id;
    }

    /**
     * Authorisatie voor het hergenereren van een api token.
     *
     * @param  User   $user     De databank entiteit van de aangemelde gebruiker.
     * @param  ApiKey $model    De databank entiteit van de API token.
     * @return bool
     */
    public function regenerateToken(User $user, ApiKey $model): bool
    {
        return $user->id === $model->apikeyable_id;
    }
}
