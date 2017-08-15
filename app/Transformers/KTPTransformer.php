<?php

namespace App\Transformers;

use App\Entities\PendudukInduk;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\KTP;

/**
 * Class KTPTransformer
 * @package namespace App\Transformers;
 */
class KTPTransformer extends TransformerAbstract
{

    /**
     * Transform the \KTP entity
     * @param \KTP $model
     *
     * @return array
     */
    public function transform(KTP $model)
    {
        return [
            'id'                   => (int) $model->id,

            'nomor_kk'              => $model->induks->nomor_kk,
            'nama'                  => $model->induks->penduduk->nama,
            'nik'                   => $model->induks->nik,
            'jenis_kelamin'         => $model->induks->penduduk->jenis_kelamin,
            'tempat_tanggal_lahir'  => $model->induks->penduduk->tempat_lahir.'/'.Carbon::parse($model->induks->penduduk->tanggal_lahir)->format('d-m-Y'),
            'golongan_darah'        => $model->induks->golongan_darah,
            'agama'                 => $model->induks->agama,
            'pendidikan'            => $model->induks->pendidikan,
            'pekerjaan'             => $model->induks->pekerjaan->nama,
            'alamat'                => $model->induks->alamat,
            'status_perkawinan'     => $model->induks->status_perkawinan,
            'tempat_tanggal_dikeluarkan'  => $model->tempat_dikeluarkan.'/'.Carbon::parse($model->tanggal_dikeluarkan)->format('d-m-Y'),
            'status_keluarga'       => $model->induks->statusKeluarga->kode,
            'kewarga_negaraan'      => $model->induks->penduduk->kewarga_negaraan,
            'ayah'                  => ($model->induks->relasiAyah) ? $model->induks->relasiAyah->penduduk->nama : ( ($model->induks->ayah) ? $model->induks->ayah : '<a class="btn btn-xs btn-default" onclick="return tambah_ayah(\''.$model->induks->nik.'\', \''.$model->induks->penduduk->nama.'\', \''.$model->induks->penduduk->id.'\')"><i class="fa fa-search-plus"></i> </a>' ),
            'ibu'                  => ($model->induks->relasiIbu) ? $model->induks->relasiIbu->penduduk->nama : ( ($model->induks->ibu) ? $model->induks->ibu : '<a class="btn btn-xs btn-default" onclick="return tambah_ibu(\''.$model->induks->nik.'\', \''.$model->induks->penduduk->nama.'\', \''.$model->induks->penduduk->id.'\')"><i class="fa fa-search-plus"></i> </a>'),
            'tanggal_mulai_di_desa' => Carbon::parse($model->tanggal_mulai_di_desa)->format('d-m-Y'),
            'keterangan'            => $model->keterangan,

            'tempat_dikeluarkan' => $model->tempat_dikeluarkan,
            'tanggal_dikeluarkan' => $model->tanggal_dikeluarkan,
            'tanggal_mulai_di_desa' => $model->tanggal_mulai_di_desa,
        ];
    }
}
