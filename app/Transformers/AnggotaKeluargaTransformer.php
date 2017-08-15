<?php

namespace App\Transformers;

use App\Entities\Pekerjaan;
use App\Entities\Penduduk;
use App\Entities\PendudukInduk;
use App\Entities\StatusKeluarga;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\AnggotaKeluarga;

/**
 * Class AnggotaKeluargaTransformer
 * @package namespace App\Transformers;
 */
class AnggotaKeluargaTransformer extends TransformerAbstract
{

    /**
     * Transform the \AnggotaKeluarga entity
     * @param \AnggotaKeluarga $model
     *
     * @return array
     */
    public function transform(PendudukInduk $model)
    {
        return [
            'id'                    => $model->id,
            'nomor_kk'              => $model->nomor_kk,
            'nama'                  => $model->penduduk->nama,
            'nik'                   => $model->nik,
            'jenis_kelamin'         => $model->penduduk->jenis_kelamin,
            'tempat_tanggal_lahir'  => $model->penduduk->tempat_lahir.'/'.Carbon::parse($model->penduduk->tanggal_lahir)->format('d-m-Y'),
            'golongan_darah'        => $model->golongan_darah,
            'agama'                 => $model->agama,
            'pendidikan'            => $model->pendidikan,
            'pekerjaan'             => $model->pekerjaan->nama,
            'alamat'                => $model->alamat,
            'status_perkawinan'     => $model->status_perkawinan,
            'tempat_tanggal_dikeluarkan' => ($model->anggotaKeluarga) ? $model->anggotaKeluarga->tempat_dikeluarkan.'/'.Carbon::parse($model->anggotaKeluarga->tanggal_dikeluarkan)->format('d-m-Y') : '',
            'status_keluarga'       => $model->statusKeluarga->kode,
            'kewarga_negaraan'      => $model->penduduk->kewarga_negaraan,
            'ayah'                  => ($model->relasiAyah) ? $model->relasiAyah->nama : (($model->ayah) ? $model->ayah :'<a class="btn btn-xs btn-default" onclick="return tambah_ayah(\''.$model->nik.'\', \''.$model->penduduk->nama.'\', \''.$model->penduduk->id.'\')"><i class="fa fa-search-plus"></i> </a>'),
            'ibu'                   => ($model->relasiIbu) ? $model->relasiIbu->nama : (($model->ibu) ? $model->ibu : '<a class="btn btn-xs btn-default" onclick="return tambah_ibu(\''.$model->nik.'\', \''.$model->penduduk->nama.'\', \''.$model->penduduk->id.'\')"><i class="fa fa-search-plus"></i> </a>'),
            'tanggal_mulai_di_desa' => ($model->anggotaKeluarga) ? $model->anggotaKeluarga->tanggal_mulai_di_desa : '',
            'keterangan'            => ($model->anggotaKeluarga) ? $model->anggotaKeluarga->keterangan : '',
        ];
    }
}
//
//
//
//