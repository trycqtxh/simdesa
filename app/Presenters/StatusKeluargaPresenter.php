<?php

namespace App\Presenters;

use App\Transformers\StatusKeluargaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class StatusKeluargaPresenter
 *
 * @package namespace App\Presenters;
 */
class StatusKeluargaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new StatusKeluargaTransformer();
    }
}
