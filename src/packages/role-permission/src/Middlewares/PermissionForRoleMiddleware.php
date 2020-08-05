<?php

namespace GGPHP\RolePermission\Middlewares;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionForRoleMiddleware
{
    public function handle($request, Closure $next, $permission)
    {

        $listPermissionUser = [];
        if (app('auth')->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = explode('|', $permission);

        $roles = app('auth')->user()->roles;

        if (is_null($roles)) {
            throw UnauthorizedException::forPermissions($permissions);
        }
        foreach ($roles as $role) {
            $permissionOfRole = $role->permissions;
            foreach ($permissionOfRole as $value) {
                $listPermissionUser[] = $value->name;
            }
        }
        foreach ($permissions as $value) {
            if (in_array($value, $listPermissionUser)) {
                return $next($request);
            }
        }
        throw UnauthorizedException::forPermissions($permissions);
    }
}
