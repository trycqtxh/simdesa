<?php

namespace App\Presenters;

use App\Transformers\RWTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RWPresenter
 *
 * @package namespace App\Presenters;
 */
class RWPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RWTransformer();
    }
}
