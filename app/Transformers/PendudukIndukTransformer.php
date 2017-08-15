<?php

namespace App\Transformers;

use App\Entities\Penduduk;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\PendudukInduk;

/**
 * Class PendudukIndukTransformer
 * @package namespace App\Transformers;
 */
class PendudukIndukTransformer extends TransformerAbstract
{

    /**
     * Transform the \PendudukInduk entity
     * @param \PendudukInduk $model
     *
     * @return array
     */
    public function transform(Penduduk $model)
    {
        return [
            'id'                => (int) $model->id,
            'nama'              => $model->nama,
            'jenis_kelamin'     => $model->jenis_kelamin,
            'status_perkawinan' => $model->pendudukInduks->first()->status_perkawinan,
            'tempat_lahir'      => $model->tempat_lahir,
            'tanggal_lahir'     => Carbon::parse($model->tanggal_lahir)->format('d-m-Y'),
            'agama'             => $model->pendudukInduks->first()->agama,
            'pendidikan'        => $model->pendudukInduks->first()->pendidikan,
            'pekerjaan'         => $model->pendudukInduks->first()->pekerjaan->nama,
            'membaca'           => $model->pendudukInduks->first()->membaca,
            'kewarga_negaraan'  => $model->kewarga_negaraan,
            'alamat'            => $model->pendudukInduks->first()->alamat,
            'status_keluarga'   => $model->pendudukInduks->first()->statusKeluarga->kode,
            'nik'               => $model->pendudukInduks->first()->nik,
            'nomor_kk'          => $model->pendudukInduks->first()->nomor_kk,
            'keterangan'        => $model->pendudukInduks->first()->keterangan,

            'dusun'             => $model->pendudukInduks->first()->dusun,
            'rw'                => $model->pendudukInduks->first()->rw_id,
            'rt'                => $model->pendudukInduks->first()->rt_id,
            'status_keluarga_id'=> $model->pendudukInduks->first()->status_keluarga_id,
            'pekerjaan_id'      => $model->pendudukInduks->first()->pekerjaan->id,
            'ayah_id'           => $model->pendudukInduks->first()->nik_ayah,
            'ibu_id'            => $model->pendudukInduks->first()->nik_ibu,
            'ayah_input'        => $model->pendudukInduks->first()->ayah,
            'ibu_input'         => $model->pendudukInduks->first()->ibu,
            'golongan_darah'    => $model->pendudukInduks->first()->golongan_darah,
        ];
    }
}
