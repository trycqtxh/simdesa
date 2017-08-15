<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\RKP;

/**
 * Class RKPTransformer
 * @package namespace App\Transformers;
 */
class RKPTransformer extends TransformerAbstract
{

    /**
     * Transform the \RKP entity
     * @param \RKP $model
     *
     * @return array
     */
    public function transform(RKP $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
