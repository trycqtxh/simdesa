<?php

namespace App\Presenters;

use App\Transformers\AparatDesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AparatDesaPresenter
 *
 * @package namespace App\Presenters;
 */
class AparatDesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AparatDesaTransformer();
    }
}
