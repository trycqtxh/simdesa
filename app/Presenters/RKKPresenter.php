<?php

namespace App\Presenters;

use App\Transformers\RKKTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RKKPresenter
 *
 * @package namespace App\Presenters;
 */
class RKKPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RKKTransformer();
    }
}
