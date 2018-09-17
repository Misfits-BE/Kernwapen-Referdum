<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\City;
use App\Signature;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        if ($signature = $this->create($input)) {
            try { // Om de postcode te vinden in de databank.
                $city = City::where('postal', $input['postcode'])->firstOrFail();
                $signature->city()->attach($city->id);
            }
            
            // lege exception omdat we niet hoeven te doen wanneer de postcode niet word gevonden.
            catch (ModelNotFoundException $exception) {
            }
        }

        return $signature;
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
