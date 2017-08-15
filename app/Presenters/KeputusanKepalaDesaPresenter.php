<?php

namespace App\Presenters;

use App\Transformers\KeputusanKepalaDesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class KeputusanKepalaDesaPresenter
 *
 * @package namespace App\Presenters;
 */
class KeputusanKepalaDesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new KeputusanKepalaDesaTransformer();
    }
}
