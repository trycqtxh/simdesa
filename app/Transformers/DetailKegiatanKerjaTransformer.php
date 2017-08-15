<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\DetailKegiatanKerja;

/**
 * Class DetailKegiatanKerjaTransformer
 * @package namespace App\Transformers;
 */
class DetailKegiatanKerjaTransformer extends TransformerAbstract
{

    /**
     * Transform the \DetailKegiatanKerja entity
     * @param \DetailKegiatanKerja $model
     *
     * @return array
     */
    public function transform(DetailKegiatanKerja $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
