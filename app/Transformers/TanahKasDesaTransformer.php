<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\TanahKasDesa;

/**
 * Class TanahKasDesaTransformer
 * @package namespace App\Transformers;
 */
class TanahKasDesaTransformer extends TransformerAbstract
{

    /**
     * Transform the \TanahKasDesa entity
     * @param \TanahKasDesa $model
     *
     * @return array
     */
    public function transform(TanahKasDesa $model)
    {
        //'id','asal_tanah','nomor_sertifikat','peroleh_tkd','luas_tkd','luas_ada_patok','luas_tidak_patok','luas_ada_papan_nama','luas_tidak_papan_nama','lokasi','manfaat','mutasi','keterangan'
        //'Asli Milik Desa','Pemerintah','Provinsi','Kabupaten','Lain-lain'
        //'Sawah','Tegalan','Kebun','Ternak / Tambak / Kolam','Tanah Kering / Darat','Hutan Belukar','Hutan Lebat / Lindung','Mutasi Tanah Di Desa','Tanah Kosong',
        return [
            'id'            => (int) $model->id,
            'asal_tanah'    => $model->asal_tanah,
            'no_sertifikat' => $model->nomor_sertifikat,

            'luas_kas'      => $model->luas,

            'kelas'         => $model->kelas,
            'milik_desa'    => ($model->peroleh_tkd == 'Asli Milik Desa') ? $model->luas_perolehan_tkd : '',
            'pemerintah'    => ($model->peroleh_tkd == 'Pemerintah') ? $model->luas_perolehan_tkd : '',
            'provinsi'      => ($model->peroleh_tkd == 'Provinsi') ? $model->luas_perolehan_tkd : '',
            'kabkota'       => ($model->peroleh_tkd == 'Kabupaten') ? $model->luas_perolehan_tkd : '',
            'lain_lain'     => ($model->peroleh_tkd == 'Lain-lain') ? $model->luas_perolehan_tkd : '',
            'tgl_perolehan' => Carbon::parse($model->tanggal_peroleh)->format('d-m-Y'),
            'sawah'         => ($model->tanahDesas->first()->penggunaan_tanah == 'Sawah') ? $model->tanahDesas->first()->luas_penggunaan : '',
            'tegal'         => ($model->tanahDesas->first()->penggunaan_tanah == 'Tegalan') ? $model->tanahDesas->first()->luas_penggunaan : '',
            'kebun'         => ($model->tanahDesas->first()->penggunaan_tanah == 'Kebun') ? $model->tanahDesas->first()->luas_penggunaan : '',
            'tambak'        => ($model->tanahDesas->first()->penggunaan_tanah == 'Ternak / Tambak / Kolam') ? $model->tanahDesas->first()->luas_penggunaan : '',
            'tanah_kering'  => ($model->tanahDesas->first()->penggunaan_tanah == 'Tanah Kering / Darat') ? $model->tanahDesas->first()->luas_penggunaan : '',

            'patok_ada'     => $model->luas_ada_patok,
            'patok_tidak'   => $model->luas_tidak_patok,
            'papan_ada'     => $model->luas_ada_papan_nama,
            'papan_tidak'   => $model->luas_tidak_papan_nama,
            'lokasi'        => $model->lokasi,
            'peruntukan'    => $model->manfaat,
            'mutasi'        => $model->mutasi,
            'keterangan'    => $model->keterangan,

            'perolehan_tkd'  => $model->peroleh_tkd,
            'luas_perolehan_tkd'  => $model->luas_perolehan_tkd,
            'jenis_tkd'  => $model->tanahDesas->first()->penggunaan_tanah,
            'luas_jenis_tkd'  => $model->tanahDesas->first()->luas_penggunaan,
            'tanggal_perolehan' => $model->tanggal_peroleh

        ];
    }
}
