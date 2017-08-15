<?php

namespace App\Presenters;

use App\Transformers\PendudukTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PendudukPresenter
 *
 * @package namespace App\Presenters;
 */
class PendudukPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PendudukTransformer();
    }
}
