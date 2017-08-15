<?php

namespace App\Presenters;

use App\Transformers\JabatanTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class JabatanPresenter
 *
 * @package namespace App\Presenters;
 */
class JabatanPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new JabatanTransformer();
    }
}
