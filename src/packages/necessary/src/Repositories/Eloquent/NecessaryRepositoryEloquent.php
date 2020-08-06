<?php

namespace GGPHP\Necessary\Repositories\Eloquent;

use GGPHP\Necessary\Models\Necessary;
use GGPHP\Necessary\Presenters\NecessaryPresenter;
use GGPHP\Necessary\Repositories\Contracts\NecessaryRepository;
use GGPHP\Storage\Services\StorageService;
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

    public function create(array $attributes)
    {
        $necessary = Necessary::create($attributes);
        if (isset($attributes['file'])) {
            $modelType = Necessary::class;
            StorageService::add($attributes['file'], $necessary->id, $modelType);
        }

        return parent::find($necessary->id);
    }

    public function update(array $attributes, $id)
    {
        $necessary = Necessary::findOrFail($id);
        $necessary->update($attributes);

        if (isset($attributes['file'])) {
            $fileId = $necessary->uploadFiles->pluck('id')->toArray();

            if (!empty($fileId)) {
                StorageService::delete($fileId);
            }
            $modelType = Necessary::class;
            StorageService::add($attributes['file'], $id, $modelType);
        }

        return parent::find($id);
    }

    public function delete($id)
    {
        $necessary = Necessary::findOrFail($id);

        if (!empty(count($necessary->uploadFiles))) {
            $fileId = $necessary->uploadFiles->pluck('id')->toArray();
            StorageService::delete($fileId);
        }

        return $necessary->delete();
    }
}
