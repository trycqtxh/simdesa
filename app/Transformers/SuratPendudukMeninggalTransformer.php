<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\Penduduk as SuratPendudukMeninggal;

/**
 * Class SuratPendudukMeninggalTransformer
 * @package namespace App\Transformers;
 */
class SuratPendudukMeninggalTransformer extends TransformerAbstract
{

    /**
     * Transform the \SuratPendudukMeninggal entity
     * @param \SuratPendudukMeninggal $model
     *
     * @return array
     */
    public function transform(SuratPendudukMeninggal $model)
    {
        return [
            'nik'                   => $model->pendudukInduks()->first()->nik,
            'nama'                  => $model->nama,
            'alamat'                => $model->pendudukInduks()->first()->alamat.' RT '.$model->pendudukInduks()->first()->rt->nama.' RW '.$model->pendudukInduks()->first()->rw->nama,
            'agama'                 => $model->pendudukInduks()->first()->agama,
            'tempat_tanggal_lahir'  => $model->tempat_lahir.', '.Carbon::parse($model->tanggal_lahir)->format('d-m-Y'),
            'umur'                  => Carbon::parse($model->tanggal_lahir)->age,
            'jenis_kelamin'         => ($model->jenis_kelamin == 'L')? 'Laki-laki' : 'Perempuan',
            'pekerjaan'             => $model->pendudukInduks()->first()->pekerjaan->nama,

            'hari_meninggal'        => ($model->mutasiMatis) ? Carbon::parse($model->mutasiMatis->first()->tanggal)->format('l') : '',
            'tanggal_meninggal'     => ($model->mutasiMatis) ? Carbon::parse($model->mutasiMatis->first()->tanggal)->format('d-m-Y') : '',
            'tempat_meninggal'      => ($model->mutasiMatis) ? $model->mutasiMatis->first()['daerah'] : '',
            'penyebab_meninggal'    => '',
        ];
    }
}
