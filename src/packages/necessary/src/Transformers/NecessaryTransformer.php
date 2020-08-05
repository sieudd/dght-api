<?php

namespace GGPHP\Necessary\Transformers;

use GGPHP\Core\Transformers\BaseTransformer;
use GGPHP\Necessary\Models\Necessary;

/**
 * Class NecessaryTransformer.
 *
 * @package namespace GGPHP\Necessary\Transformers;
 */
class NecessaryTransformer extends BaseTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [];

}
