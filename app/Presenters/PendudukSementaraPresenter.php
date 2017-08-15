<?php

namespace App\Presenters;

use App\Transformers\PendudukSementaraTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PendudukSementaraPresenter
 *
 * @package namespace App\Presenters;
 */
class PendudukSementaraPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PendudukSementaraTransformer();
    }
}
