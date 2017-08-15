<?php

namespace App\Presenters;

use App\Transformers\TanahDesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TanahDesaPresenter
 *
 * @package namespace App\Presenters;
 */
class TanahDesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TanahDesaTransformer();
    }
}
