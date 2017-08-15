<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\RW;

/**
 * Class RWTransformer
 * @package namespace App\Transformers;
 */
class RWTransformer extends TransformerAbstract
{

    /**
     * Transform the \RW entity
     * @param \RW $model
     *
     * @return array
     */
    public function transform(RW $model)
    {
        return [
            'id'         => (int) $model->id,
            'rw'         => $model->nama,
            'petugas'    => $model->petugas,
        ];
    }
}
