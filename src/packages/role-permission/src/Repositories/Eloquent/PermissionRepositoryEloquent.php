<?php

namespace GGPHP\RolePermission\Repositories\Eloquent;

use GGPHP\RolePermission\Models\Permission;
use GGPHP\RolePermission\Repositories\Contracts\PermissionRepository;
use Illuminate\Support\Facades\Route;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ImageRepositoryEloquent.
 *
 * @package namespace GGPHP\RolePermission\Repositories\Eloquent;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    public function presenter()
    {
        return \GGPHP\RolePermission\Presenters\PermissionPresenter::class;
    }

    /*
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Override method get
     * @param  array  $attributes attributes from request
     * @return object
     */
    public function getPermission(array $attributes)
    {
        $dataPermission = [];

        foreach (Route::getRoutes()->getRoutes() as $route) {
            if (strpos($route->uri, 'api') !== false) {
                $action = $route->getAction();
                if (array_key_exists('as', $action) && array_key_exists('comment', $action)) {
                    $dataPermission[] = [
                        "name" => $action['as'],
                        "description" => $action['comment'],
                        "guard_name" => "api",
                        "group" => isset($action['group']) ? $action['group'] : "Khác",
                    ];
                }
            }
        }

        foreach ($dataPermission as $permission) {
            Permission::updateOrCreate(["name" => $permission['name']], $permission);
        }

        $this->resetModel();

        if (!empty($attributes['limit'])) {
            $permission = $this->paginate($attributes['limit']);
        } else {
            $permission = $this->get();
        }

        return $permission;
    }

    /**
     * Override method create
     * @param  array  $attributes attributes from request
     * @return object
     */
    public function create(array $attributes)
    {
        $configPermission = config('permission');
        $mode = $configPermission['mode'][$attributes['mode_type']]['class'];

        $attributes['mode_id'] = implode(',', $attributes['mode_id']);
        $attributes['name'] = $attributes['mode_type'] . $attributes['mode_id'];
        $attributes['mode_type'] = $mode;
        $permission = Permission::create($attributes);

        return $permission;
    }
}
