<?php

namespace App\Presenters;

use App\Transformers\SuratMenyuratTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class SuratMenyuratPresenter
 *
 * @package namespace App\Presenters;
 */
class SuratMenyuratPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new SuratMenyuratTransformer();
    }
}
