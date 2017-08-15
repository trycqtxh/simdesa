<?php

namespace App\Presenters;

use App\Transformers\BidangTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BidangPresenter
 *
 * @package namespace App\Presenters;
 */
class BidangPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BidangTransformer();
    }
}
