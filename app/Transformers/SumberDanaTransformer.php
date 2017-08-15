<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SumberDana;

/**
 * Class SumberDanaTransformer
 * @package namespace App\Transformers;
 */
class SumberDanaTransformer extends TransformerAbstract
{

    /**
     * Transform the \SumberDana entity
     * @param \SumberDana $model
     *
     * @return array
     */
    public function transform(SumberDana $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
