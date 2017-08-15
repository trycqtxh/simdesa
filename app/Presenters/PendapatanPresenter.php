<?php

namespace App\Presenters;

use App\Transformers\PendapatanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PendapatanPresenter
 *
 * @package namespace App\Presenters;
 */
class PendapatanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PendapatanTransformer();
    }
}
