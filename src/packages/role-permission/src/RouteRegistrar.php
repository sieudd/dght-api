<?php

namespace GGPHP\RolePermission;

use GGPHP\Core\RouteRegistrar as CoreRegistrar;

class RouteRegistrar extends CoreRegistrar
{
    /**
     * The namespace implementation.
     */
    protected static $namespace = '\GGPHP\RolePermission\Http\Controllers';

    /**
     * Register routes for bread.
     *
     * @return void
     */
    public function all()
    {
        $this->forBread();
    }

    /**
     * Register the routes needed for managing clients.
     *
     * @return void
     */
    public function forBread()
    {
        $this->router->group(['middleware' => []], function ($router) {
            //permissions
            \Route::get('permissions', [
                'uses' => 'PermissionController@index',
                'as' => 'permissions.index',
            ]);

            \Route::post('permissions', [
                'uses' => 'PermissionController@store',
                'as' => 'permissions.store',
            ]);

            \Route::put('permissions/{id}', [
                'uses' => 'PermissionController@update',
                'as' => 'permissions.update',
            ]);

            \Route::get('permissions/{id}', [
                'uses' => 'PermissionController@show',
                'as' => 'permissions.show',
            ]);

            \Route::delete('permissions/{id}', [
                'uses' => 'PermissionController@destroy',
                'as' => 'permissions.destroy',
            ]);

            //roles
            \Route::get('roles', [
                'uses' => 'RoleController@index',
                'as' => 'roles.index',
            ]);

            \Route::post('roles', [
                'uses' => 'RoleController@store',
                'as' => 'roles.store',
            ]);

            \Route::put('roles/{id}', [
                'uses' => 'RoleController@update',
                'as' => 'roles.update',
            ]);

            \Route::get('roles/{id}', [
                'uses' => 'RoleController@show',
                'as' => 'roles.show',
            ]);

            \Route::delete('roles/{id}', [
                'uses' => 'RoleController@destroy',
                'as' => 'roles.destroy',
            ]);

            \Route::put('roles/permission/{id}', [
                'uses' => 'RoleController@updatePermissionRole',
                'as' => 'roles.permission.update',
            ]);
        });
    }
}
