<?php

namespace App\Presenters;

use App\Transformers\IndukSelectAparatTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class IndukSelectAparatPresenter
 *
 * @package namespace App\Presenters;
 */
class IndukSelectAparatPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new IndukSelectAparatTransformer();
    }
}
