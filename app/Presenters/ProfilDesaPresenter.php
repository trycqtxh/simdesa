<?php

namespace App\Presenters;

use App\Transformers\ProfilDesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProfilDesaPresenter
 *
 * @package namespace App\Presenters;
 */
class ProfilDesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProfilDesaTransformer();
    }
}
