<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Pekerjaan;

/**
 * Class PekerjaanTransformer
 * @package namespace App\Transformers;
 */
class PekerjaanTransformer extends TransformerAbstract
{

    /**
     * Transform the \Pekerjaan entity
     * @param \Pekerjaan $model
     *
     * @return array
     */
    public function transform(Pekerjaan $model)
    {
        return [
            'id'         => (int) $model->id,
            'pekerjaan'       => $model->nama,
        ];
    }
}
