<?php

namespace App\Transformers;

use App\Entities\AdmSurat;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\AgendaDesa;

/**
 * Class AgendaDesaTransformer
 * @package namespace App\Transformers;
 */
class AgendaDesaTransformer extends TransformerAbstract
{

    /**
     * Transform the \AgendaDesa entity
     * @param \AgendaDesa $model
     *
     * @return array
     */
    public function transform(AdmSurat $model)
    {
        return [
            'id'         => (int) $model->id,

            'tanggal_pengiriman' => Carbon::parse($model->tanggal_pengirim_penerima)->format('d-m-Y'),
            'nomor_masuk' => ($model->jenis == "masuk") ? $model->nomor_surat : '',
            'tanggal_masuk' => ($model->jenis == "masuk") ? Carbon::parse($model->tanggal_surat)->format('d-m-Y') : '',
            'nama_pengirim_masuk' => ($model->jenis == "masuk") ? $model->pengirim_penerima : '',
            'isi_singkat_masuk' => ($model->jenis == "masuk") ? $model->isi_surat : '',
            'nomor_keluar' => ($model->jenis == "keluar") ? $model->nomor_surat : '',
            'tanggal_keluar' => ($model->jenis == "keluar") ? Carbon::parse($model->tanggal_surat)->format('d-m-Y')  : '',
            'ditujukan_kepada' => ($model->jenis == "keluar") ? $model->pengirim_penerima : '',
            'isi_singkat_keluar' => ($model->jenis == "keluar") ? $model->isi_surat : '',
            'keterangan' =>$model->keterangan
        ];
    }
}
