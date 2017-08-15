<?php

namespace App\Presenters;

use App\Transformers\SubPendapatanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SubPendapatanPresenter
 *
 * @package namespace App\Presenters;
 */
class SubPendapatanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SubPendapatanTransformer();
    }
}
