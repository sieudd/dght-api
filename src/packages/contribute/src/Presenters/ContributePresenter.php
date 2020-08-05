<?php

namespace GGPHP\Contribute\Presenters;

use GGPHP\Contribute\Transformers\ContributeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ContributePresenter.
 *
 * @package namespace App\Presenters;
 */
class ContributePresenter extends FractalPresenter
{
    /**
     * @var string
     */
    protected $resourceKeyItem = 'Contribute';

    /**
     * @var string
     */
    protected $resourceKeyCollection = 'Contribute';

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ContributeTransformer();
    }
}
