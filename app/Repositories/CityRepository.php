<?php 

namespace App\Repositories;

use App\City;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Pagination\Paginator;

/**
 * Class CityRepository
 *
 * @package App\Repositories
 */
class CityRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return City::class;
    }

    /**
     * Oplijsting van alle gemeentes in de databak. 
     *  
     * @param  int $perPage Het aantal steden dat je wilt weergeven per stad.
     * @return Paginator 
     */
    public function listCities(int $perPage): Paginator
    {
        return $this->entity()->simplePaginate($perPage);
    }
}