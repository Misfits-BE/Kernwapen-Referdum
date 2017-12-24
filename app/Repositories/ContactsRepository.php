<?php 

namespace App\Repositories;

use App\Contact;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;

/**
 * Class ContactsRepository
 *
 * @package App\Repositories
 */
class ContactsRepository extends Repository
{

    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model()
    {
        return Contact::class;
    }
}