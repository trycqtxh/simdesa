<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\KegiatanKerja;

/**
 * Class KegiatanKerjaTransformer
 * @package namespace App\Transformers;
 */
class KegiatanKerjaTransformer extends TransformerAbstract
{

    /**
     * Transform the \KegiatanKerja entity
     * @param \KegiatanKerja $model
     *
     * @return array
     */
    public function transform(KegiatanKerja $model)
    {
        return [
            'id'         => (int) $model->id,
            'sub_bidang' => $model->kegiatan_kerja_id,
            'jenis_kegiatan' => $model->uraian,
            'lokasi' => $model->detailKegiatanKerjas->first()->lokasi,
            'volume' => $model->detailKegiatanKerjas->first()->volume,
            'manfaat' => $model->detailKegiatanKerjas->first()->manfaat,
            'jumlah' => $model->detailKegiatanKerjas->first()->jumlah_dana,
            'sumber_dana' => $model->detailKegiatanKerjas->first()->sumber_dana_id,
            'pola_pelaksanaan' => $model->detailKegiatanKerjas->first()->pola_pelaksanaan,
            'bidang_id' => $model->bidang_id,
        ];
    }
}
