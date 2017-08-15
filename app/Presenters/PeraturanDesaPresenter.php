<?php

namespace App\Presenters;

use App\Transformers\PeraturanDesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PeraturanDesaPresenter
 *
 * @package namespace App\Presenters;
 */
class PeraturanDesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PeraturanDesaTransformer();
    }
}
