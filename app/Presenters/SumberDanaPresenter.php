<?php

namespace App\Presenters;

use App\Transformers\SumberDanaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SumberDanaPresenter
 *
 * @package namespace App\Presenters;
 */
class SumberDanaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SumberDanaTransformer();
    }
}
