<?php

namespace App\Presenters;

use App\Transformers\PendudukIndukTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PendudukIndukPresenter
 *
 * @package namespace App\Presenters;
 */
class PendudukIndukPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PendudukIndukTransformer();
    }
}
