<?php

namespace App\Presenters;

use App\Transformers\SuratPendudukMeninggalTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SuratPendudukMeninggalPresenter
 *
 * @package namespace App\Presenters;
 */
class SuratPendudukMeninggalPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SuratPendudukMeninggalTransformer();
    }
}
