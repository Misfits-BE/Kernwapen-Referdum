<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\Signature;

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
    public function model(): string
    {
        return Signature::class;
    }

    /**
     * Slaag een handtekening op in het systeem.
     *
     * @param  array $input De gegeven invoer van de gebruiker. (Validatie -> controller)
     * @return Signature
     */
    public function createSignature(array $input): Signature
    {
        return $this->create($input);
    }

    /**
     * Tel alle hand tekeningen in de databank op return ze naar de controller.
     *
     * @return int
     */
    public function countSignatures(): int
    {
        return $this->model->count();
    }
}
