<?php

namespace GGPHP\Contribute\Transformers;

use GGPHP\Contribute\Models\Contribute;
use GGPHP\Core\Transformers\BaseTransformer;
use GGPHP\Users\Transformers\UserTransformer;

/**
 * Class ContributeTransformer.
 *
 * @package namespace GGPHP\Contribute\Transformers;
 */
class ContributeTransformer extends BaseTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['contributor', 'contributeDetails'];

    /**
     * Include UserRequest
     * @param  Contribute $contribute
     */
    public function includeContributor(Contribute $contribute)
    {
        if (empty($contribute->contributorUser)) {
            return;
        }
        return $this->item($contribute->contributorUser, new UserTransformer, 'Contributor');
    }

    /**
     * Include contributeDetails
     * @param  Contribute $contribute
     */
    public function includeContributeDetails(Contribute $contribute)
    {
        return $this->collection($contribute->contributeDetails, new ContributeDetailTransformer, 'ContributeDetail');
    }

}
