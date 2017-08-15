<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\RT;

/**
 * Class RTTransformer
 * @package namespace App\Transformers;
 */
class RTTransformer extends TransformerAbstract
{

    /**
     * Transform the \RT entity
     * @param \RT $model
     *
     * @return array
     */
    public function transform(RT $model)
    {
        return [
            'id'     => (int) $model->id,
            'rt'     => $model->nama,
            'petugas'=> $model->petugas,
            'rw'     => $model->rw->nama,
            'rw_id'     => $model->rw_id,
        ];
    }
}
