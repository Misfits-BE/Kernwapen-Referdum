<?php 

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

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
     * @return mixed
     */
    public function listRoles(array $fields)
    {
        return $this->all($fields);
    }
}