<?php

namespace App\Presenters;

use App\Transformers\PembiayaanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PembiayaanPresenter
 *
 * @package namespace App\Presenters;
 */
class PembiayaanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PembiayaanTransformer();
    }
}
