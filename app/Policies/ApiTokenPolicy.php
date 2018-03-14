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
 * @author
 * @copyright
 * @package
 */
class ApiTokenPolicy
{
    use HandlesAuthorization;
}
