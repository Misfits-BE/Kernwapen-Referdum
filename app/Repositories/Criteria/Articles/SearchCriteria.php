<?php 

namespace App\Repositories\Criteria\Articles; 

use ActivismeBE\DatabaseLayering\Repositories\Criteria\Criteria;
use ActivismeBE\DatabaseLayering\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class SearchCriteria
 *
 * @author      Tim Joosten 
 * @copyright   2018 Tim Joosten
 * @package     App\Repositories\Criteria
 */
class SearchCriteria extends Criteria
{
    protected $term;    /** @var string $term   The user given term from the search form. */
    protected $column;  /** @var string $column The name for the database columnu want to search on */

    /**
     * SearchCriteria constructor
     * 
     * @param  string $column The name for the database column u want to search on
     * @param  string $term   The user given search term form the search form. 
     * @return void
     */
    public function __construct(string $column, string $term)
    {
        $this->term   = $term; 
        $this->column = $column;
    }

    /**
     * Appy the query in the main SQL query 
     * 
     * @param mixed                 $model      The model instance where you want to perform the action in.   
     * @param RepositoryInterface   $repository The interface for the repository class.
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository): Builder
    {
        return $model->where($this->column, 'LIKE', '%' . $this->term . '%');
    }
}