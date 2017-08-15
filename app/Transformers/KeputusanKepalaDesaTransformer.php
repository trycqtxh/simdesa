<?php

namespace App\Transformers;

use App\Entities\PeraturanDesa;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

/**
 * Class KeputusanKepalaDesaTransformer
 * @package namespace App\Transformers;
 */
class KeputusanKepalaDesaTransformer extends TransformerAbstract
{

    /**
     * Transform the \KeputusanKepalaDesa entity
     * @param \KeputusanKepalaDesa $model
     *
     * @return array
     */
    public function transform(PeraturanDesa $model)
    {
        return [
            'id'               => (int) $model->id,
            'keputusan'  => $model->nomor_ditetapkan.'/'.Carbon::parse($model->tanggal_ditetapkan)->format('d-m-Y'),
            'judul'            => $model->tentang,
            'uraian'           => $model->uraian,
            'dilaporkan' => $model->nomor_laporan.'/'.Carbon::parse($model->tanggal_laporan)->format('d-m-Y'),
            'keterangan'       => $model->keterangan,
        ];
    }
}
