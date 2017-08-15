<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\PendudukInduk as SuratPenduduk;

/**
 * Class SuratPendudukTransformer
 * @package namespace App\Transformers;
 */
class SuratPendudukTransformer extends TransformerAbstract
{

    /**
     * Transform the \SuratPenduduk entity
     * @param \SuratPenduduk $model
     *
     * @return array
     */
    public function transform(SuratPenduduk $model)
    {
        setlocale(LC_TIME, 'Indonesian');
        $status_perkawinan = '';
        switch($model->status_perkawinan){
            case 'BK':
                $status_perkawinan = 'Belum Kawin';
                break;
            case 'K':
                $status_perkawinan = 'Kawin';
                break;
            case 'DD':
                $status_perkawinan = 'Duda';
                break;
            case 'JD':
                $status_perkawinan = 'Janda';
                break;
        }
        $penduduk = $model->penduduk;
        return [
            'nik'                   => $model->nik,
            'nama'                  => $model->penduduk->nama,
            'alamat'                => $model->alamat.' RT '.$model->rt->nama.' RW '.$model->rw->nama,
            'agama'                 => $model->agama,
            'tempat_tanggal_lahir'  => $model->penduduk->tempat_lahir.', '.Carbon::parse($model->penduduk->tanggal_lahir)->format('d-m-Y'),
            'umur'                  => Carbon::parse($model->penduduk->tanggal_lahir)->age,
            'jenis_kelamin'         => ($model->penduduk->jenis_kelamin == 'L')? 'Laki-laki' : 'Perempuan',
            'warga_negara'          => $model->penduduk->kewarga_negaraan,
            'status_perkawinan'     => $status_perkawinan,
            'pekerjaan'             => $model->pekerjaan->nama,
            'pendidikan'            => $model->pendidikan,

            'hari_lahir'            => Carbon::parse($model->penduduk->tanggal_lahir)->format('l'),
            'tanggal_lahir'         => Carbon::parse($model->penduduk->tanggal_lahir)->format('d-m-Y'),
            'jam_lahir'             => '',
            'tempat_lahir'          => $model->penduduk->tempat_lahir,

            'ayah'                  => ($model->RelasiAyah) ? $model->RelasiAyah->penduduk->nama : $model->ayah,
            'nik_ayah'              => ($model->RelasiAyah) ? $model->RelasiAyah->nik : '',
            'umur_ayah'             => ($model->RelasiAyah) ? Carbon::parse($model->RelasiAyah->penduduk->tanggal_lahir)->age : '',
            'pekerjaan_ayah'        => ($model->RelasiAyah) ? $model->RelasiAyah->pekerjaan->nama : '',
            'alamat_ayah'           => ($model->RelasiAyah) ? $model->RelasiAyah->alamat : '',

            'ibu'                   => ($model->RelasiIbu) ? $model->RelasiIbu->penduduk->nama : $model->ibu,
            'nik_ibu'               => ($model->RelasiIbu) ? $model->RelasiIbu->nik : '',
            'umur_ibu'              => ($model->RelasiIbu) ? Carbon::parse($model->RelasiIbu->penduduk->tanggal_lahir)->age : '',
            'pekerjaan_ibu'         => ($model->RelasiIbu) ? $model->RelasiIbu->pekerjaan->nama : '',
            'alamat_ibu'            => ($model->RelasiIbu) ? $model->RelasiIbu->alamat : '',

        ];
    }
}
