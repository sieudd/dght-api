<?php

namespace GGPHP\Contribute\Models;

use GGPHP\Core\Models\CoreModel;

class ContributeDetailRequest extends CoreModel
{
    /**
     * Declare the table name
     */
    protected $table = 'contribute_detail_requests';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contribute_detail_id', 'request_id', 'amount',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Define relations request
     */
    public function request()
    {
        return $this->belongsTo(\GGPHP\Request\Models\Request::class, 'request_id');
    }
}
