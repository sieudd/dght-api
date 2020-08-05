<?php

namespace GGPHP\Contribute\Repositories\Eloquent;

use GGPHP\Contribute\Models\Contribute;
use GGPHP\Contribute\Models\ContributeDetail;
use GGPHP\Contribute\Models\ContributeDetailRequest;
use GGPHP\Contribute\Presenters\ContributePresenter;
use GGPHP\Contribute\Repositories\Contracts\ContributeRepository;
// use GGPHP\Users\Jobs\SendEmail;
use GGPHP\Users\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ContributeRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquent;
 */
class ContributeRepositoryEloquent extends BaseRepository implements ContributeRepository
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
        return Contribute::class;
    }

    /**
     * Specify Presenter class name
     *
     * @return string
     */
    public function presenter()
    {
        return ContributePresenter::class;
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
        if (!empty($attributes['user_contributor'])) {
            $password = Str::random(8);
            $attributes['user_contributor']['type'] = 'DONG_GOP';
            $attributes['user_contributor']['password'] = Hash::make($password);

            $user = User::create($attributes['user_contributor']);
            // send mail
            $email = $user->email;
            $name = $user->name;
            $urlLogin = env('LOGIN_URL', 'http://localhost:11005/login');
            // dispatch(new SendEmail(compact('email', 'password', 'name', 'urlLogin')));
        }

        $attributes['contributor'] = $user->id;

        $contribute = Contribute::create($attributes);

        foreach ($attributes['contributing_component'] as $value) {
            $value['contribute_id'] = $contribute->id;
            $contributeDetail = ContributeDetail::create($value);

            if (!empty($value['requests'])) {
                foreach ($value['requests'] as $request) {
                    $request['contribute_detail_id'] = $contributeDetail->id;
                    $contributeDetailRequest = ContributeDetailRequest::create($request);
                }
            }
        }

        return parent::find($contribute->id);
    }

}
