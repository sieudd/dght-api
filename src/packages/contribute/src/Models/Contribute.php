<?php

namespace GGPHP\Contribute\Models;

use GGPHP\Core\Models\CoreModel;

class Contribute extends CoreModel
{
    /**
     * Declare the table name
     */
    protected $table = 'contributes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contributor', 'status', 'donation_form',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Define relations user
     */
    public function contributorUser()
    {
        return $this->belongsTo(\GGPHP\Users\Models\User::class, 'contributor');
    }

    /**
     * Define relations contributeDetails
     */
    public function contributeDetails()
    {
        return $this->hasMany(\GGPHP\Contribute\Models\ContributeDetail::class);
    }

}
