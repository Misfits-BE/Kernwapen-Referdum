<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use App\City;
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
    public function model(): string
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

    /**
     * Creeer de stad in de databank.
     *
     * @param  array $input. De gegeven invoer die afkomstig is van de seeder.
     * @return City
     */
    public function seedCreate(array $input): City
    {
        return $this->create($input);
    }

    /**
     * Bepaal de flash message indien de gemeente kernwapen vrij is of niet.
     *
     * @param  bool $status De status. Is de gemeente kernwapen vrij of niet?
     * @param  City $city   De databank entiteit van de gemeente
     * @return string
     */
    public function determineFlashSession(bool $status, City $city): string
    {
        switch ($status) {
            case true:  return "{$city->name} heeft zich kernwapen vrij verklaard.";
            case false: return "{$city->name} heeft zich niet kernwapen vrij verklaard.";

            // Indien geen van beide is gegeven
            default: return "Kon niet uitmaken of de stad kernwapen vrij is of niet.";
        }
    }

    /**
     * Zoek voor een specifieke waarde. En tel de gevonden records op.
     *
     * @param  string $column De naam van de databank kolom.
     * @param  mixed  $value  De waarde van de gegeven databank kolom.
     * @return int
     */
    public function count(string $column, $value): int
    {
        return $this->entity()->where($column, $value)->count();
    }

    /**
     * Tel alle kernvrije gemeentes in de databank op.
     *
     * @return int
     */
    public function countKernVrij(): int
    {
        return $this->entity()->where('kernwapen_vrij', true)->count();
    }

    /**
     * Doorzoek De databank tabel voor een specifieke stad. Gebaseerd op naam of postcode.
     *
     * @param  string $term    De opgegeven zoek term.
     * @param  int    $perPage De aantal steden die u wilt laten zien per pagina.
     * @return Paginator
     */
    public function searchCities(string $term, int $perPage): Paginator
    {
        return $this->entity()->where('postal', 'LIKE', "%{$term}%")
            ->orWhere('name', 'LIKE', "%{$term}%")
            ->simplePaginate($perPage);
    }
}
