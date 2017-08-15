<?php

namespace App\Presenters;

use App\Transformers\PendudukMutasiTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PendudukMutasiPresenter
 *
 * @package namespace App\Presenters;
 */
class PendudukMutasiPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PendudukMutasiTransformer();
    }
}
