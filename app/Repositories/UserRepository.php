<?php 

namespace App\Repositories;

use App\User;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use RuntimeException;
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
        $user = factory(User::class)->create(['password' => 'secret']);
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
     * Wijzig de account beveiliging in de databank. 
     * 
     * @param  array $user The aangemelde gebruiker. 
     * @return int
     */
    public function updateUser(array $input): int
    {
        return $this->update($input, auth()->user()->id);
    }

    /**
     * Haal de gebruikers op in de database en splits ze op per page.
     *
     * @param  int    $perPage  Het aantal data records in een pagina weergave.
     * @param  string $type     Type van de paginatie.
     * @return Paginator
     */
    public function paginateUsers(int $perPage, string $type): Paginator
    {
        switch ($type) {
            case 'default': return $this->entity()->paginate($perPage);
            case 'simple' : return $this->entity()->simplePaginate($perPage);

            // Geen geldig formaat gegeven.
            default: throw new RuntimeException('The type param can only contains simple or default', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Verwijder een gebruiker uit de databank.
     *
     * @param  int $user De unieke nummer voor de gebruiker in de databank.
     * @return int
     */
    public function deleteUser(int $user): int
    {
        return $this->delete($user);
    }
}