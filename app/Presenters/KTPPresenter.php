<?php

namespace App\Presenters;

use App\Transformers\KTPTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class KTPPresenter
 *
 * @package namespace App\Presenters;
 */
class KTPPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new KTPTransformer();
    }
}
