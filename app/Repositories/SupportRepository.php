<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\Support;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\Paginator;

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
    public function model(): string
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
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginateOrgs(int $perPage, string $type): Paginator
    {
        switch ($type) {
            case 'simple':  return $this->entity()->simplePaginate($perPage);
            case 'default': return $this->paginate($perPage);

            default: return $this->paginate($perPage);
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

    /**
     * Zoek voor een specifieke ondersteunende organisatie in de databank.
     *
     * @param  string   $term       De gegeven zoek term door de gebruiker
     * @param  int      $perPage    Het aantal resultaten per pagina.
     * @return \Illuminate\Pagination\Paginator
     */
    public function searchOrganization(string $term, int $perPage): Paginator
    {
        return $this->entity()->where('name', 'LIKE', "%{$term}%")->simplePaginate(15);
    }
}
