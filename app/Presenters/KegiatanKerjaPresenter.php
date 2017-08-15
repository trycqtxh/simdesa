<?php

namespace App\Presenters;

use App\Transformers\KegiatanKerjaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class KegiatanKerjaPresenter
 *
 * @package namespace App\Presenters;
 */
class KegiatanKerjaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new KegiatanKerjaTransformer();
    }
}
