<?php

namespace App\Presenters;

use App\Transformers\AgendaDesaTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class AgendaDesaPresenter
 *
 * @package namespace App\Presenters;
 */
class AgendaDesaPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new AgendaDesaTransformer();
    }
}
