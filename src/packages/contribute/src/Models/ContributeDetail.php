<?php

namespace GGPHP\Contribute\Models;

use GGPHP\Core\Models\CoreModel;

class ContributeDetail extends CoreModel
{
    /**
     * Declare the table name
     */
    protected $table = 'contribute_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contribute_id', 'necessary_id', 'amount',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Define relations contributeDetailRequests
     */
    public function contributeDetailRequests()
    {
        return $this->hasMany(\GGPHP\Contribute\Models\ContributeDetailRequest::class);
    }

    /**
     * Define relations necessary
     */
    public function necessary()
    {
        return $this->belongsTo(\GGPHP\Necessary\Models\Necessary::class, 'necessary_id');
    }

}
