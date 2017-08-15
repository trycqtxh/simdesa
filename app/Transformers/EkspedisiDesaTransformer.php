<?php

namespace App\Transformers;

use App\Entities\AdmSurat;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\EkspedisiDesa;

/**
 * Class EkspedisiDesaTransformer
 * @package namespace App\Transformers;
 */
class EkspedisiDesaTransformer extends TransformerAbstract
{

    /**
     * Transform the \EkspedisiDesa entity
     * @param \EkspedisiDesa $model
     *
     * @return array
     */
    public function transform(AdmSurat $model)
    {
        return [
            'id'                        => (int) $model->id,
            'tanggal_pengirim_penerima' => $model->tanggal_pengirim_penerima,
            'tanggal_nomor_surat' => Carbon::parse($model->tanggal_surat)->format('d-m-Y').' / '.$model->nomor_surat,
            'pengirim_penerima' => $model->isi_surat,
            'isi_surat' => $model->pengirim_penerima,
            'keterangan' => $model->keterangan
        ];
    }
}
