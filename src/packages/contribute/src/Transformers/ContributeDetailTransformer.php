<?php

namespace GGPHP\Contribute\Transformers;

use GGPHP\Contribute\Models\ContributeDetail;
use GGPHP\Core\Transformers\BaseTransformer;

/**
 * Class ContributeDetailTransformer.
 *
 * @package namespace GGPHP\Contribute\Transformers;
 */
class ContributeDetailTransformer extends BaseTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $defaultIncludes = ['contributeDetailRequests'];

    /**
     * Include contributeDetails
     * @param  ContributeDetail $contributeDetail
     */
    public function includeContributeDetailRequests(ContributeDetail $contributeDetail)
    {
        return $this->collection($contributeDetail->contributeDetailRequests, new ContributeDetailRequestTransformer, 'ContributeDetailRequest');
    }
}
