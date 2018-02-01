<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\Notitions;
use App\City;

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

    /**
     * Implementatie van een notitie wanneer een gemeente kernwapen vrij of niet word verklaard. 
     * 
     * @param  bool $kernwapenVrij  De status indicator. TRUE = kernwapen vrij, FALSE = niet kpernwapen vrij
     * @param  int  $city           De unieke identificatie waarde van de stad in de databank. 
     * @return void 
     */
    public function notitionKernvrij(bool $kernwapenVrij, int $city): void
    {
        $city     = City::findOrFail($city);

        $notition            = new Notitions;  
        $notition->author_id = auth()->user()->id; 
        $notition->status    = 0; // Indicator voor een publieke notitie. 

        if ($kernwapenVrij) { 
            $notition->titel        = 'Heeft zich kernwapen vrij verklaard. ';
            $notition->beschrijving = $city . ' heeft zich kernwapen vrij verklaard.';
        } else {
            $notition->titel        = 'Heeft zijn steun als kernwapen vrije gemeente ingetrokken.';
            $notition->beschrijving = $city . ' heeft zijn steun als kernwapen vrije gemeente ingetrokken.';
        }   

        $city->notitions()->save($notition);
    }
}
