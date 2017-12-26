<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\Support;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;
use RuntimeException;

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

    /**
     * Pagineer de ondersteunende organisaties uit de databank.
     *
     * @param  int      $perPage    Het aantal resultaten per pagina.
     * @param  string   $type       Het type van de paginatie die nodig is.
     * @return Paginator
     */
    public function paginateOrgs(int $perPage, string $type): Paginator
    {
        switch ($type) {
            case 'simple':  return $this->entity()->simplePaginate($perPage);
            case 'default': return $this->paginate($perPage);

            // Geen correct type gegeven dus smijt een runtime exception.
            default: throw new RuntimeException('The needs to ben simple or default', 500);
        }
    }

    /**
     * Creer een ondersteunende organisatie in de databank.
     *
     * @param  array $input De gegeven invoer voor de databank
     * @return Support
     */
    public function createOrganization(array $input): Support
    {
        return $this->create($input);
    }

    /**
     * Verwijder een ondersteunende organisatie uit de databank.
     *
     * @param  int $organisatie De unieke waarde van de organisatie.
     * @return bool
     */
    public function deleteOrganisation(int $organisatie): bool
    {
        return $this->delete($organisatie);
    }
}
