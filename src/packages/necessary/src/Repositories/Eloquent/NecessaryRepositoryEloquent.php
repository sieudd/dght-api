<?php

namespace GGPHP\Necessary\Repositories\Eloquent;

use GGPHP\Necessary\Models\Necessary;
use GGPHP\Necessary\Presenters\NecessaryPresenter;
use GGPHP\Necessary\Repositories\Contracts\NecessaryRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class NecessaryRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class NecessaryRepositoryEloquent extends BaseRepository implements NecessaryRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id',
        'name',
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Necessary::class;
    }

    /**
     * Specify Presenter class name
     *
     * @return string
     */
    public function presenter()
    {
        return NecessaryPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
