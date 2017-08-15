<?php

namespace App\Presenters;

use App\Transformers\TanahKasDesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TanahKasDesaPresenter
 *
 * @package namespace App\Presenters;
 */
class TanahKasDesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TanahKasDesaTransformer();
    }
}
