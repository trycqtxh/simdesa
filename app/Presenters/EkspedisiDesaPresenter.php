<?php

namespace App\Presenters;

use App\Transformers\EkspedisiDesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class EkspedisiDesaPresenter
 *
 * @package namespace App\Presenters;
 */
class EkspedisiDesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new EkspedisiDesaTransformer();
    }
}
