<?php

namespace GGPHP\RolePermission\Transformers;

use GGPHP\Core\Transformers\BaseTransformer;
use GGPHP\Users\Transformers\UserTransformer;
use Spatie\Permission\Models\Role;

/**
 * Class RolesTransformer.
 *
 * @package namespace App\Transformers;
 */
class RoleTransformer extends BaseTransformer
{
    /**
     * Array attribute doesn't parse.
     */
    public $ignoreAttributes = [];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['permission', 'users'];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [];

    public function customAttributes($model): array
    {
        return [
            'name' => $model->name,
            'guard_name' => $model->guard_name,
            'store_id' => $model->store_id,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

    /**
     * Include Permission
     * @param  Store $store
     */
    public function includePermission(Role $role)
    {
        return $this->collection($role->permissions, new PermissionTransformer, 'Permission');
    }

    /**
     * Include Permission
     * @param  Store $store
     */
    public function includeUsers(Role $role)
    {
        return $this->collection($role->users, new UserTransformer, 'User');
    }
}
