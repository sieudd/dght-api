<?php

namespace GGPHP\Necessary\Models;

use GGPHP\Core\Models\CoreModel;

class Necessary extends CoreModel
{
    /**
     * Declare the table name
     */
    protected $table = 'necessaries';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'unit',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function request()
    {
        return $this->hasMany(\GGPHP\Request\Models\Request::class);
    }

    public function contributeDetail()
    {
        return $this->hasMany(\GGPHP\Contribute\Models\ContributeDetail::class);
    }

}
