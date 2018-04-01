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

                $signature->update(['unsubscribe_token' => $this->generateSignatureToken()]);
            }
            
            // lege exception omdat we niet hoeven te doen wanneer de postcode niet word gevonden.
            catch (ModelNotFoundException $exception) {
                //
            }
        }

        return $signature;
    }

    /**
     * Verwijder een handtekening uit het systeem. 
     * 
     * @param  string $token De token van de handtekening in het systeem. 
     * @return bool
     */
    public function deleteSignature(string $token): bool 
    {
        try {
            $baseQuery = $this->entity()->where('unsubscribe_token', $token);

            if ($baseQuery->count() === 1 && $baseQuery->delete()) {
                return true;
            }
        } catch (ModelNotFoundException $excepttion) {
            return false;
        }
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

    /**
     * Genereer een token voor de handtekening. 
     * ----
     * Dit is nodig voor de functionaliteit dat de gebruiker zijn handtekening zelf kan verwijderen. 
     * 
     * @return string
     */
    protected function generateSignatureToken(): string 
    {
        do {
            $salt   = sha1(time() . mt_rand());
            $newKey = substr($salt, 0, 40);
        } // Do blijft zich herhalen tot er een match is aangemaakt die niet bestaat in de databank.
        
        while ($this->keyExists($newKey));

        return $newKey;
    }

    /**
     * Check of de token bestaat in de databank of niet.
     *
     * @param  string $key De gegenereerde token.
     * @return bool
     */
    private function keyExists(string $key): bool
    {
        $tokenCount = $this->entity()->where('unsubscribe_token', $key)->limit(1)->count();
        
        if ($tokenCount > 0) {
            return true;
        }

        return false;
    }
}
