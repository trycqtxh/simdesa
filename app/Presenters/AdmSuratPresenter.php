<?php

namespace App\Presenters;

use App\Transformers\AdmSuratTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AdmSuratPresenter
 *
 * @package namespace App\Presenters;
 */
class AdmSuratPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AdmSuratTransformer();
    }
}
