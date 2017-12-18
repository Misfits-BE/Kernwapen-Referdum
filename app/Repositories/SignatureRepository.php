<?php 

namespace App\Repositories;

use App\Signature;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class SignatureRepository
 *
 * @package App\Repositories
 */
class SignatureRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Signature::class;
    }
}