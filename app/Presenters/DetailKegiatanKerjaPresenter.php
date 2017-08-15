<?php

namespace App\Presenters;

use App\Transformers\DetailKegiatanKerjaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DetailKegiatanKerjaPresenter
 *
 * @package namespace App\Presenters;
 */
class DetailKegiatanKerjaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DetailKegiatanKerjaTransformer();
    }
}
