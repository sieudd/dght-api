<?php

namespace GGPHP\Storage\Models;

use GGPHP\Core\Models\CoreModel;

/**
 * Class UploadFile.
 *
 * @package namespace App\Models;
 */
class UploadFile extends CoreModel
{
    const IMAGE = 'image';
    const FILE = 'file';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'upload_files';

    protected $fillable = ['name', 'path', 'object_id', 'object_type', 'type'];

    /**
     * Define relations object
     */
    public function uploadFileTable()
    {
        return $this->morphTo();
    }

}
