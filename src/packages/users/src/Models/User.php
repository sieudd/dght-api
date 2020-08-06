<?php

namespace GGPHP\Users\Models;

use GGPHP\Core\Models\CoreModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends CoreModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Notifiable, HasApiTokens, CanResetPassword;
    use Authenticatable;
    use Authorizable, CanResetPassword, MustVerifyEmail;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'type_contribute', 'founding', 'phone_number', 'address', 'business', 'business_code', 'contact_name',
    ];

    protected $dateTimeFields = [
        'founding',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'founding' => 'datetime',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

}
