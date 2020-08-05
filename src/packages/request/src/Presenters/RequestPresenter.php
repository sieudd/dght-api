<?php

namespace GGPHP\Request\Presenters;

use GGPHP\Request\Transformers\RequestTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RequestPresenter.
 *
 * @package namespace App\Presenters;
 */
class RequestPresenter extends FractalPresenter
{
    /**
     * @var string
     */
    protected $resourceKeyItem = 'Request';

    /**
     * @var string
     */
    protected $resourceKeyCollection = 'Request';

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RequestTransformer();
    }
}
