<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\Province;

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

    /**
     * Haal de eerste provincie op bij naam.
     * Indien niet gevonden word er een provincie aangemaakt.
     *
     * @param  array $province De naam van de provincie.
     * @return Province
     */
    public function seedCreate(array $province): Province
    {
        return $this->entity()->firstOrCreate($province);
    }
}
