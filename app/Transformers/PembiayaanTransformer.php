<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Pembiayaan;

/**
 * Class PembiayaanTransformer
 * @package namespace App\Transformers;
 */
class PembiayaanTransformer extends TransformerAbstract
{

    /**
     * Transform the \Pembiayaan entity
     * @param \Pembiayaan $model
     *
     * @return array
     */
    public function transform(Pembiayaan $model)
    {
        return [
            'id'         => (int) $model->id,
            'uraian'     => $model->uraian,
            'anggaran'   => $model->jumlah_dana,
            'keterangan' => $model->keterangan,
        ];
    }
}
