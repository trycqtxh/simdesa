<?php

namespace App\Presenters;

use App\Transformers\PekerjaanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PekerjaanPresenter
 *
 * @package namespace App\Presenters;
 */
class PekerjaanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PekerjaanTransformer();
    }
}
