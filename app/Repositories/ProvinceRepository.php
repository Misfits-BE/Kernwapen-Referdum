<?php 

namespace App\Repositories;

use App\Province;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class ProvinceRepository
 *
 * @package App\Repositories
 */
class ProvinceRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Province::class;
    }
}