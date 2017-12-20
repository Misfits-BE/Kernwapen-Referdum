<?php 

namespace App\Repositories;

use App\User;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Spatie\Permission\Models\Role;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * Creer een nieuwe gebruiker per toegangs rol. (seeder)
     *
     * @param  Role     $role       De naam van de gebruikers rol.
     * @param  mixed    $commandBus Mapping voor $this->command in de seeder
     * @return void
     */
    public function seedCreateUser(Role $role, $commandBus): void
    {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);

        if ($role->name == 'admin' ) {
            $commandBus->info('Here is your admin details to login:');
            $commandBus->warn($user->email);
            $commandBus->warn('Password is "secret"');
        }
    }

    /**
     * Get the database output for the currently authenticated user. 
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->find(auth()->user()->id, ['name', 'email']);
    }

    /**
     * Wijzig de accoutn beveiliging in de databank. 
     * 
     * @param  array $user The aangemelde gebruiker. 
     * @return int
     */
    public function updateUser(array $input): int
    {
        return $this->update($input, auth()->user()->id);
    }
}