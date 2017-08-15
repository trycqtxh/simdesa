<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Pendapatan;

/**
 * Class PendapatanTransformer
 * @package namespace App\Transformers;
 */
class PendapatanTransformer extends TransformerAbstract
{

    /**
     * Transform the \Pendapatan entity
     * @param \Pendapatan $model
     *
     * @return array
     */
    public function transform(Pendapatan $model)
    {
        return [
            'id'         => (int) $model->id,
            'uraian'     => $model->uraian,
            'anggaran'   => $model->jumlah_dana,
            'keterangan' => $model->keterangan
        ];
    }
}
