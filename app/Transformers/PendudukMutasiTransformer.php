<?php

namespace App\Transformers;

use App\Entities\Penduduk;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\PendudukMutasi;

/**
 * Class PendudukMutasiTransformer
 * @package namespace App\Transformers;
 */
class PendudukMutasiTransformer extends TransformerAbstract
{

    /**
     * Transform the \PendudukMutasi entity
     * @param \PendudukMutasi $model
     *
     * @return array
     */
    public function transform(Penduduk $model)
    {
        $jenis = $model->pendudukMutasis->first()['jenis'];
        $daerah = $model->pendudukMutasis->first()['daerah'];
        $tanggal = $model->pendudukMutasis->first()['tanggal'];
        return [
            'id'                => (int) $model->id,
            'nama'              => $model->nama,
            'tempat_lahir'      => $model->tempat_lahir,
            'tanggal_lahir'     => Carbon::parse($model->tanggal_lahir)->format('d-m-Y'),
            'jenis_kelamin'     => $model->jenis_kelamin,
            'kewarga_negaraan'  => $model->kewarga_negaraan,
            'datang_dari'       => ($jenis == "MASUK") ? $daerah : '',
            'datang_tanggal'    => ($jenis == "MASUK") ? $tanggal : '',
            'pindah_ke'         => ($jenis == "KELUAR") ? $daerah : '',
            'pindah_tanggal'    => ($jenis == "KELUAR") ? $tanggal : '',
            'meninggal'         => ($jenis == "MATI") ? $daerah : '',
            'meninggal_tanggal' => ($jenis == "MATI") ? $tanggal : '',
            'keterangan'        => $model->pendudukMutasis->first()['keterangan'],
            'jenis'        => $model->pendudukMutasis->first()['jenis'],
        ];
    }
}
