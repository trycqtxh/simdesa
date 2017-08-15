<?php

namespace App\Presenters;

use App\Transformers\InventarisDesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class InventarisDesaPresenter
 *
 * @package namespace App\Presenters;
 */
class InventarisDesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new InventarisDesaTransformer();
    }
}
