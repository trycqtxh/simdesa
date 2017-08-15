<?php

namespace App\Presenters;

use App\Transformers\RTTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RTPresenter
 *
 * @package namespace App\Presenters;
 */
class RTPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RTTransformer();
    }
}
