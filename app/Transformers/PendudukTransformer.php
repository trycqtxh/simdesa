<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Penduduk;

/**
 * Class PendudukTransformer
 * @package namespace App\Transformers;
 */
class PendudukTransformer extends TransformerAbstract
{

    /**
     * Transform the \Penduduk entity
     * @param \Penduduk $model
     *
     * @return array
     */
    public function transform(Penduduk $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
