<?php 

namespace App\Repositories;

use App\Article;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use ActivismeBE\DatabaseLayering\Repositories\Eloquent\Repository;
use Illuminate\Pagination\Paginator;

/**
 * Class ArticleRepository
 *
 * @package App\Repositories
 */
class ArticleRepository extends Repository
{
    /**
     * Set the eloquent model class for the repository.
     *
     * @return string
     */
    public function model(): string
    {
        return Article::class;
    }

    /**
     * Get all the news articles out of the database (paginated form)
     * 
     * @param  int $perPage The amount of results u want to display per page. 
     * @return Paginator
     */
    public function paginateArticles($perPage): Paginator
    {
        return $this->model->simplePaginate($perPage);
    }
}