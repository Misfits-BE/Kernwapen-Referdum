<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\Http\Requests\Backend\ApiKeyValidator;
use Misfits\ApiGuard\Models\ApiKey;

/**
 * Class ApiKeyRepository
 *
 * @author      Tim Joosten <topairy@gmail.com>
 * @copyright   2018 Tim Joosten
 * @package     App\Repositories
 */
class ApiKeyRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return ApiKey::class;
    }

    /**
     * Creer een nieuwe API TOKEN in de databank.
     *
     * @param  ApiKeyValidator $input De door gebruiker gegeven input data
     * @return ApiKey
     */
    public function storeKey(ApiKeyValidator $input): ApiKey
    {
        $apiKey = auth()->user()->createApiKey();
        
        if ($apiKey && $apiKey->update(['service' => $input->service])) {
            return $apiKey;
        }
    }
}
