<?php

namespace GGPHP\Request\Transformers;

use GGPHP\Core\Transformers\BaseTransformer;
use GGPHP\Necessary\Transformers\NecessaryTransformer;
use GGPHP\Request\Models\Request;
use GGPHP\Users\Transformers\UserTransformer;

/**
 * Class RequestTransformer.
 *
 * @package namespace GGPHP\Request\Transformers;
 */
class RequestTransformer extends BaseTransformer
{

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['userRequest', 'necessary'];

    /**
     * Transform the User entity.
     *
     * @param User $model
     *
     * @return array
     */
    public function customAttributes($model): array
    {
        $totalQuantityReceived = 0;
        $totalQuantityShortage = 0;
        $totalExcessAmount = 0;

        if (!empty(count($model->contributeDetailRequest))) {
            foreach ($model->contributeDetailRequest as $contributeDetailRequest) {
                $totalQuantityReceived += $contributeDetailRequest->amount;
            }
        }

        if ($model->amount > $totalQuantityReceived) {
            $totalQuantityShortage = $model->amount - $totalQuantityReceived;
        }

        if ($model->amount < $totalQuantityReceived) {
            $totalExcessAmount = $totalQuantityReceived - $model->amount;
        }
        return [
            'totalQuantityReceived' => $totalQuantityReceived,
            'totalQuantityShortage' => $totalQuantityShortage,
            'totalExcessAmount' => $totalExcessAmount,
        ];
    }

    /**
     * Include UserRequest
     * @param  Request $request
     */
    public function includeUserRequest(Request $request)
    {
        if (empty($request->userRequest)) {
            return;
        }
        return $this->item($request->userRequest, new UserTransformer, 'UserRequest');
    }

    /**
     * Include shift
     * @param  Request $request
     */
    public function includeNecessary(Request $request)
    {
        if (empty($request->necessary)) {
            return;
        }
        return $this->item($request->necessary, new NecessaryTransformer, 'Necessary');
    }

}
