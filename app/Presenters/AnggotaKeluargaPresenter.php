<?php

namespace App\Presenters;

use App\Transformers\AnggotaKeluargaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AnggotaKeluargaPresenter
 *
 * @package namespace App\Presenters;
 */
class AnggotaKeluargaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AnggotaKeluargaTransformer();
    }
}
