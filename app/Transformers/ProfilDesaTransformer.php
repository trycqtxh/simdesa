<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\ProfilDesa;

/**
 * Class ProfilDesaTransformer
 * @package namespace App\Transformers;
 */
class ProfilDesaTransformer extends TransformerAbstract
{

    /**
     * Transform the \ProfilDesa entity
     * @param \ProfilDesa $model
     *
     * @return array
     */
    public function transform(ProfilDesa $model)
    {
        return [
            'id'         => (int) $model->id,
            'index'      => $model->index,
            'value'      => $model->value,
 
            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
