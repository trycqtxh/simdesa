<?php

namespace App\Presenters;

use App\Transformers\BeritaDesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class LembarBeritaDesaPresenter
 *
 * @package namespace App\Presenters;
 */
class BeritaDesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BeritaDesaTransformer();
    }
}
