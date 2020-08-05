<?php

namespace GGPHP\RolePermission\Repositories\Eloquent;

use DB;
use GGPHP\RolePermission\Models\Role;
use GGPHP\RolePermission\Repositories\Contracts\RoleRepository;
use GGPHP\Users\Models\User;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ImageRepositoryEloquent.
 *
 * @package namespace GGPHP\RolePermission\Repositories\Eloquent;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    public function presenter()
    {
        return \GGPHP\RolePermission\Presenters\RolePresenter::class;
    }

    /*
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function updatePermissionRole(array $attributes, $id)
    {
        $role = $this->model()::findOrFail($id);
        if (!empty($attributes['permission'])) {
            if ($attributes['delete']) {
                $role->revokePermissionTo($attributes['permission']);
            } else {
                $role->givePermissionTo($attributes['permission']);
            }
        }
        return parent::find($id);
    }

    /**
     * Override method create
     * @param  array  $attributes attributes from request
     * @return object
     */
    public function create(array $attributes)
    {
        $role = $this->model()::create(\Arr::except($attributes, ['user_id']));

        if (!empty($attributes['user_id'])) {
            foreach ($attributes['user_id'] as $key => $id) {

                $user = User::find($id);
                $user->assignRole($role->id);
            }

        }
        return parent::find($role->id);
    }

    /**
     * Override method update
     * @param  array  $attributes attributes from request
     * @return object
     */
    public function update(array $attributes, $id)
    {
        $role = $this->model()::where('id', $id)->update(\Arr::except($attributes, ['user_id']));

        if (!empty($attributes['user_id'])) {
            DB::table('model_has_roles')->where('role_id', $id)->where('model_type', 'GGPHP\Users\Models\User')->delete();
            foreach ($attributes['user_id'] as $key => $userId) {
                $user = User::find($userId);
                $user->assignRole($id);
            }
        }
        return parent::find($id);
    }

    /**
     * Override method delete
     * @param  array  $attributes attributes from request
     * @return object
     */
    public function delete($id)
    {
        DB::table('model_has_roles')->where('role_id', $id)->where('model_type', 'GGPHP\Users\Models\User')->delete();

        return parent::delete($id);
    }
}
