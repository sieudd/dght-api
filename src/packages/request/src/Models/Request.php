<?php

namespace GGPHP\Request\Models;

use GGPHP\Core\Models\CoreModel;

class Request extends CoreModel
{
    /**
     * Declare the table name
     */
    protected $table = 'requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_request', 'necessary_id', 'amount', 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Define relations userRequest
     */
    public function userRequest()
    {
        return $this->belongsTo(\GGPHP\Users\Models\User::class, 'user_request');
    }

    /**
     * Define relations necessary
     */
    public function necessary()
    {
        return $this->belongsTo(\GGPHP\Necessary\Models\Necessary::class, 'necessary_id');
    }

    /**
     * Define relations user
     */
    public function contributeDetailRequest()
    {
        return $this->hasMany(\GGPHP\Contribute\Models\ContributeDetailRequest::class);
    }

}
