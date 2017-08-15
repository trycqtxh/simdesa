<?php

namespace App\Presenters;

use App\Transformers\KelompokPendudukTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class KelompokPendudukPresenter
 *
 * @package namespace App\Presenters;
 */
class KelompokPendudukPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new KelompokPendudukTransformer();
    }
}
