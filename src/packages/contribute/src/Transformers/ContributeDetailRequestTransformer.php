<?php

namespace GGPHP\Contribute\Transformers;

use GGPHP\Contribute\Models\ContributeDetailRequest;
use GGPHP\Core\Transformers\BaseTransformer;
use GGPHP\Request\Transformers\RequestTransformer;

/**
 * Class ContributeDetailRequestTransformer.
 *
 * @package namespace GGPHP\Contribute\Transformers;
 */
class ContributeDetailRequestTransformer extends BaseTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['request'];

    /**
     * Include Request
     * @param  ContributeDetailRequest $contributeDetailRequest
     */
    public function includeRequest(ContributeDetailRequest $contributeDetailRequest)
    {
        if (empty($contributeDetailRequest->request)) {
            return;
        }
        return $this->item($contributeDetailRequest->request, new RequestTransformer, 'Request');
    }
}
