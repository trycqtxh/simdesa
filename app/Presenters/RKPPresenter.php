<?php

namespace App\Presenters;

use App\Transformers\RKPTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RKPPresenter
 *
 * @package namespace App\Presenters;
 */
class RKPPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RKPTransformer();
    }
}
