<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\AparatDesa;

/**
 * Class AparatDesaTransformer
 * @package namespace App\Transformers;
 */
class AparatDesaTransformer extends TransformerAbstract
{

    /**
     * Transform the \AparatDesa entity
     * @param \AparatDesa $model
     *
     * @return array
     */
    public function transform(AparatDesa $model)
    {
        return [
            'id'           => (int) $model->id,
            'nama'         => $model->induk->penduduk->nama,
            'niap'         => $model->niap,
            'nip'          => $model->nip,
            'jenis_kelamin'=> ($model->induk->penduduk->jenis_kelamin == "L") ? "Laki-Laki" : "Perempuan",
            'tempat_tanggal_lahir'  => $model->induk->penduduk->tempat_lahir.'/'.Carbon::parse($model->induk->penduduk->tanggal_lahir)->format('d-m-Y'),
            'agama'        => $model->induk->agama,
            'golongan'     => $model->golongan,
            'jabatan'      => $model->jabatan->nama,
            'pendidikan'   => $model->induk->pendidikan,
            'nomor_tanggal_pengangkatan' => $model->no_pengangkatan.', '.Carbon::parse($model->tanggal_pengangkatan)->format('d-m-Y'),
            'nomor_tanggal_pemberhentian'=> $model->tanggal_pemberhentian ? $model->no_pemberhentian.', '.Carbon::parse($model->tanggal_pemberhentian)->format('d-m-Y'): '',
            'keterangan'   => $model->keterangan,
        ];
    }
}
