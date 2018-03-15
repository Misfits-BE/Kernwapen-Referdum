<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use App\User;

/**
 * Class RoleRepository
 *
 * @package App\Repositories
 */
class RoleRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Role::class;
    }

    /**
     * Creer een nieuwe rol in het systeem.
     *
     * Dit is een functie voor de UsersTableSeeder die rust op de
     * Eloquent ORM ->firstOrCreate() methode.
     *
     * @param  array $role De naam voor de rol
     * @return Role
     */
    public function seedFirstOrCreate(array $role): Role
    {
        return $this->model->firstOrCreate($role);
    }

    /**
     * Oplijsting voor de systeem rollen;
     *
     * @param  array $fields De array van de nodige database columns.
     * @return Collection
     */
    public function listRoles(array $fields): Collection
    {
        return $this->entity()->where('name', '!=', 'api')->get($fields);
    }

    /**
     * Registreet in de ACL api toegang voor een gebruikers account. 
     * 
     * @param  string $user         De gebruikers entiteit uit de databank.
     * @param  string $apiAccess    De chck of een gebruiker al dan wel of niet api toegang moet krijgen.
     * @return void
     */
    public function apiAccess(User $user, string $apiAccess): void 
    {
        switch ($apiAccess) {
            case 'access':    $user->assingRole('api');  
            case 'no-access': $user->removeRole('api');
        }
    }
}
