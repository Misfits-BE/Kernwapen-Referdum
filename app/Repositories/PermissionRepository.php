<?php 

namespace App\Repositories;

use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionRepository
 *
 * @package App\Repositories
 */
class PermissionRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Permission::class;
    }

    /**
     * Creer een nieuwe permissie in het systeem.
     *
     * Dit is een functie voor de UsersTableSeeder die rust op de
     * Eloquent ORM ->firstOrCreate() methode.
     *
     * @param  array $permissions De naam voor de permissie
     * @return Permission
     */
    public function seedFirstOrCreate(array $permissions): Permission
    {
        return $this->model->firstOrCreate($permissions);
    }
}
