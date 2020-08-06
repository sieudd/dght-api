<?php

namespace GGPHP\Request\Repositories\Eloquent;

use GGPHP\Request\Models\Request;
use GGPHP\Request\Presenters\RequestPresenter;
use GGPHP\Request\Repositories\Contracts\RequestRepository;
// use GGPHP\Users\Jobs\SendEmail;
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
        'user_request',
        'necessary_id',
        'status',
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

    public function create(array $attributes)
    {
        foreach ($attributes['data'] as $value) {
            $value['user_request'] = $attributes['user_request'];
            $request = Request::create($value);
            $request_id[] = $request->id;
        }

        $results = Request::whereIn('id', $request_id)->get();

        return $this->parserResult($results);
    }

    public function approval($id, array $attributes)
    {
        $request = Request::find($id);

        $request->update($attributes);
        if ($attributes['status'] === 'DUYET') {
            $dataMail = [
                'email' => $request->userRequest->email,
                'name' => $request->userRequest->name,
                'name_necessary' => $request->necessary->name,
                'unit' => $request->necessary->unit,
                'amount' => $request->amount,
            ];
            // dispatch(new SendEmail($dataMail, 'REQUEST_APPROVAL'));
        }

        return $this->parserResult($request);
    }
}
