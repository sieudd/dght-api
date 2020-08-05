<?php

namespace GGPHP\Storage\Transformers;

use GGPHP\Core\Transformers\BaseTransformer;
use GGPHP\Storage\Models\UploadFile;

/**
 * Class UploadFileTransformer.
 *
 * @package namespace App\Transformers;
 */
class UploadFileTransformer extends BaseTransformer
{
    /**
     * Array attribute doesn't parse.
     */
    public $ignoreAttributes = [];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = [];
}
