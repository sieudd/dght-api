<?php

namespace GGPHP\RolePermission\Middlewares;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Exceptions\UnauthorizedException;

class CheckPermissionView
{
    public function handle($request, Closure $next, $permission)
    {
        $permissions = explode('|', $permission);

        $configPermission = config('permission');
        $mode = $configPermission['mode'][$permission];
        $children = isset($mode['children']) ? $mode['children'] : null;

        $roles = app('auth')->user()->roles;
        $permissionOfRoles = null;
        $model_id = [];

        if (empty(count($roles))) {
            throw UnauthorizedException::forPermissions($permissions);
        }
        foreach ($roles as $role) {
            $permissionOfRoles = $role->permissions->where('mode_type', $mode['class']);
        }

        if (empty(count($permissionOfRoles))) {
            return $next($request);
        }

        foreach ($permissionOfRoles as $permissionOfRole) {
            $permission = explode(",", $permissionOfRole->mode_id);
            foreach ($permission as $value) {
                array_push($model_id, $value);
            }
        }

        if (!empty($model_id)) {
            if (!isset($mode['children'])) {
                $mode['class']::addGlobalScope('where_in', function (Builder $builder) use ($model_id) {
                    $builder->whereIn('id', $model_id);
                });
            } else {
                $mode['children']['class']::addGlobalScope('where_in', function (Builder $builder) use ($model_id) {
                    $builder->whereIn('id', $model_id);
                });

                $mode['class']::addGlobalScope('where_in_relationship', function (Builder $builder) use ($mode, $model_id) {
                    $builder->whereHas($mode['children']['relationship'], function ($q) use ($model_id) {
                        $q->whereIn('id', $model_id);
                    })->with([$mode['children']['relationship'] => function ($q) use ($model_id) {
                        $q->whereIn('id', $model_id);
                    }]);
                });
            }
        }

        return $next($request);

    }
}
