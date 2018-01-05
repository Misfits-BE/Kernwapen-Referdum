<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\Notitions;

/**
 * Class NotitionsRepository
 *
 * @package App\Repositories
 */
class NotitionsRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Notitions::class;
    }

    /**
     * Voorbereiding van de data omtrent de notitie
     *
     * @param  mixed $înput De data rechtstreeks van de data validator instantie.
     * @return Notitions
     */
    public function prepHasMany($input): Notitions
    {
        $notition               = new Notitions;
        $notition->author_id    = $input->user()->id;
        $notition->titel        = $input->titel;
        $notition->status       = $input->status;
        $notition->beschrijving = $input->beschrijving;

        return $notition;
    }
}
