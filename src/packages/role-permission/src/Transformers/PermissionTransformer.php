<?php

namespace GGPHP\RolePermission\Transformers;

use GGPHP\Core\Transformers\BaseTransformer;
use Spatie\Permission\Models\Permission;

/**
 * Class PermissionsTransformer.
 *
 * @package namespace App\Transformers;
 */
class PermissionTransformer extends BaseTransformer
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
    protected $availableIncludes = ['role'];

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
            'description' => $model->description,
            'group' => $model->group,
            'group_slug' => $model->group_slug,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
        ];
    }

    /**
     * Include Role
     * @param  Permission $permission
     */
    public function includeRole(Permission $permission)
    {
        return $this->collection($permission->roles, new RoleTransformer, 'Role');
    }
}
