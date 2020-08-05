<?php

namespace GGPHP\Necessary\Presenters;

use GGPHP\Necessary\Transformers\NecessaryTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class NecessaryPresenter.
 *
 * @package namespace App\Presenters;
 */
class NecessaryPresenter extends FractalPresenter
{
    /**
     * @var string
     */
    protected $resourceKeyItem = 'Necessary';

    /**
     * @var string
     */
    protected $resourceKeyCollection = 'Necessary';

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new NecessaryTransformer();
    }
}
