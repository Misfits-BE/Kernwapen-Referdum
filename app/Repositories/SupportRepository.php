<?php 

namespace App\Repositories;

use App\Support;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class SupportRepository
 *
 * @package App\Repositories
 */
class SupportRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Support::class;
    }

    /**
     * Oplijsting van alle ondersteunende organisaties in het systeem.
     * 
     * @return Support
     */
    public function listSupports(): Collection
    {
        return $this->all();
    }
}