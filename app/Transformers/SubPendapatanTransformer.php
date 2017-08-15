<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SubPendapatan;

/**
 * Class SubPendapatanTransformer
 * @package namespace App\Transformers;
 */
class SubPendapatanTransformer extends TransformerAbstract
{

    /**
     * Transform the \SubPendapatan entity
     * @param \SubPendapatan $model
     *
     * @return array
     */
    public function transform(SubPendapatan $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
