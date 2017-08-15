<?php

namespace App\Presenters;

use App\Transformers\SuratPendudukTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SuratPendudukPresenter
 *
 * @package namespace App\Presenters;
 */
class SuratPendudukPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SuratPendudukTransformer();
    }
}
