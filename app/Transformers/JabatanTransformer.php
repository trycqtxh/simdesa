<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Jabatan;

/**
 * Class JabatanTransformer
 * @package namespace App\Transformers;
 */
class JabatanTransformer extends TransformerAbstract
{

    /**
     * Transform the \Jabatan entity
     * @param \Jabatan $model
     *
     * @return array
     */
    public function transform(Jabatan $model)
    {
        return [
            'id'     => (int) $model->id,
            'kode'   => $model->kode,
            'jabatan'=> $model->nama
        ];
    }
}
