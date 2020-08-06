<?php

namespace GGPHP\Necessary\Transformers;

use GGPHP\Contribute\Transformers\ContributeDetailTransformer;
use GGPHP\Core\Transformers\BaseTransformer;
use GGPHP\Necessary\Models\Necessary;
use GGPHP\Request\Transformers\RequestTransformer;
use GGPHP\Storage\Transformers\UploadFileTransformer;

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
    protected $availableIncludes = ['requests', 'contributeDetails', 'uploadFile'];

    /**
     * Transform the User entity.
     *
     * @param User $model
     *
     * @return array
     */
    public function customAttributes($model): array
    {
        $totalAmountRequired = 0;
        $totalQuantityReceived = 0;
        $totalQuantityShortage = 0;
        $totalExcessAmount = 0;
        $percent = 0;

        $requestApprovals = $model->request->where('status', 'DUYET');

        if (!empty(count($requestApprovals))) {
            foreach ($requestApprovals as $requestApproval) {
                $totalAmountRequired += $requestApproval->amount;
            }
        }

        if (!empty(count($model->contributeDetail))) {
            foreach ($model->contributeDetail as $contributeDetail) {
                $totalQuantityReceived += $contributeDetail->amount;
            }
        }

        if ($totalAmountRequired > $totalQuantityReceived) {
            $totalQuantityShortage = $totalAmountRequired - $totalQuantityReceived;
        }

        if ($totalAmountRequired < $totalQuantityReceived) {
            $totalExcessAmount = $totalQuantityReceived - $totalAmountRequired;
        }

        if ($totalAmountRequired != 0) {
            $percent = ($totalQuantityReceived * 100) / $totalAmountRequired;
            if ($percent > 100) {
                $percent = 100;
            }
        }

        return [
            'totalAmountRequired' => $totalAmountRequired,
            'totalQuantityReceived' => $totalQuantityReceived,
            'totalQuantityShortage' => $totalQuantityShortage,
            'totalExcessAmount' => $totalExcessAmount,
            'percent' => $percent,
        ];
    }

    /**
     * Include request
     * @param  Necessary $necessary
     */
    public function includeRequests(Necessary $necessary)
    {
        $request = $necessary->request->where('status', 'DUYET');
        return $this->collection($request, new RequestTransformer, 'Request');
    }

    /**
     * Include contributeDetails
     * @param  Necessary $necessary
     */
    public function includeContributeDetails(Necessary $necessary)
    {
        return $this->collection($necessary->contributeDetail, new ContributeDetailTransformer, 'ContributeDetail');
    }

    /**
     * include uploadfile
     * @param  Necessary $necessary
     */
    public function includeUploadFile(Necessary $necessary)
    {
        return $this->collection($necessary->uploadFiles, new UploadFileTransformer, 'UploadFile');
    }

}
