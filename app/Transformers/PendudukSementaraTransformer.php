<?php

namespace App\Transformers;

use App\Entities\Penduduk;
use League\Fractal\TransformerAbstract;
use App\Entities\PendudukSementara;
use Carbon\Carbon;
/**
 * Class PendudukSementaraTransformer
 * @package namespace App\Transformers;
 */
class PendudukSementaraTransformer extends TransformerAbstract
{

    /**
     * Transform the \PendudukSementara entity
     * @param \PendudukSementara $model
     *
     * @return array
     */
    public function transform(Penduduk $model)
    {
        return [
            'id'                   => (int) $model->id,
            'nama'                 => $model->nama,
            'laki'                 => ($model->jenis_kelamin == "L") ? $model->jenis_kelamin : '',
            'perempuan'            => ($model->jenis_kelamin == "P") ? $model->jenis_kelamin : '',
            'no_identitas'         => $model->pendudukSementaras->first()['no_identitas'],
            'tempat_tanggal_lahir' => $model->tempat_lahir.', '.Carbon::parse($model->tanggal_lahir)->format('d-m-Y'),
            'pekerjaan'            => $model->pendudukSementaras->first()->pekerjaan->nama,
            'kewarga_negaraan'     => $model->kewarga_negaraan,
            'keturunan'            => $model->pendudukSementaras->first()['turunan'],
            'datang_dari'          => $model->pendudukSementaras->first()['daerah_asal'],
            'maksud_tujuan'        => $model->pendudukSementaras->first()['tujuan'],
            'alamat_tujuan'        => $model->pendudukSementaras->first()['alamat_tujuan'],
            'datang_tanggal'       => $model->pendudukSementaras->first()['tanggal_datang'],
            'pergi_tanggal'        => $model->pendudukSementaras->first()['tanggal_pergi'],
            'keterangan'           => $model->pendudukSementaras->first()['keterangan'],
            'pekerjaan_id'            => $model->pendudukSementaras->first()->pekerjaan->id,
        ];
    }
}
