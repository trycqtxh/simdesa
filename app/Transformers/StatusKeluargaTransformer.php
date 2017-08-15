<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\StatusKeluarga;

/**
 * Class StatusKeluargaTransformer
 * @package namespace App\Transformers;
 */
class StatusKeluargaTransformer extends TransformerAbstract
{

    /**
     * Transform the \StatusKeluarga entity
     * @param \StatusKeluarga $model
     *
     * @return array
     */
    public function transform(StatusKeluarga $model)
    {
        return [
            'id'         => (int) $model->id,
            'kode'       => $model->kode,
            'status'     => $model->nama,
        ];
    }
}
