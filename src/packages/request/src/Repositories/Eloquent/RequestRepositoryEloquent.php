<?php

namespace GGPHP\Request\Repositories\Eloquent;

use GGPHP\Request\Models\Request;
use GGPHP\Request\Presenters\RequestPresenter;
use GGPHP\Request\Repositories\Contracts\RequestRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RequestRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class RequestRepositoryEloquent extends BaseRepository implements RequestRepository
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
        return Request::class;
    }

    /**
     * Specify Presenter class name
     *
     * @return string
     */
    public function presenter()
    {
        return RequestPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
