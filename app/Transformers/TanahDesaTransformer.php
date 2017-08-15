<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\TanahDesa;

/**
 * Class TanahDesaTransformer
 * @package namespace App\Transformers;
 */
class TanahDesaTransformer extends TransformerAbstract
{

    /**
     * Transform the \TanahDesa entity
     * @param \TanahDesa $model
     *
     * @return array
     */
    public function transform(TanahDesa $model)
    {
        //'id','nama','status_tanah','luas_status','penggunaan_tanah','luas_penggunaan','lain','id_tanah_kas_desa','keterangan'/
        //,, ,'hgu','hpl','ma','vi','tn'
        //'Sawah','Tegalan','Kebun','Ternak / Tambak / Kolam','Tanah Kering / Darat','Hutan Belukar','Hutan Lebat / Lindung','Mutasi Tanah Di Desa','Tanah Kosong',
        //'Perumahan','Perdagangan dan Jasa','Perkantoran','Industri','Fasilitas Umum'
        return [
            'id'              => (int) $model->id,
            'nama'            => $model->nama,
            'jumlah'          => $model->jumlah,
            'hm'              => ($model->status_tanah == 'hm' ) ? $model->luas_status : '',
            'hgb'             => ($model->status_tanah == 'hgb') ? $model->luas_status : '',
            'hp'              => ($model->status_tanah == 'hp' ) ? $model->luas_status : '',
            'hgu'             => ($model->status_tanah == 'hgu') ? $model->luas_status : '',
            'hpl'             => ($model->status_tanah == 'hpl') ? $model->luas_status : '',
            'ma'              => ($model->status_tanah == 'ma') ? $model->luas_status : '',
            'vi'              => ($model->status_tanah == 'vi') ? $model->luas_status : '',
            'tn'              => ($model->status_tanah == 'tn') ? $model->luas_status : '',
            'non_perumahan'   => ($model->penggunaan_tanah == 'Perumahan') ? $model->luas_penggunaan : '',
            'non_perdagangan' => ($model->penggunaan_tanah == 'Perdagangan dan Jasa') ? $model->non_perdagangan : '',
            'non_perkantoran' => ($model->penggunaan_tanah == 'Perkantoran') ? $model->luas_penggunaan : '',
            'non_industri'    => ($model->penggunaan_tanah == 'Industri') ? $model->luas_penggunaan : '',
            'non_fasilitas'   => ($model->penggunaan_tanah == 'Fasilitas Umum') ? $model->luas_penggunaan : '',
            'sawah'           => ($model->penggunaan_tanah == 'Sawah') ? $model->luas_penggunaan : '',
            'tegalan'         => ($model->penggunaan_tanah == 'Tegalan') ? $model->luas_penggunaan : '',
            'perkebunan'      => ($model->penggunaan_tanah == 'Kebun') ? $model->luas_penggunaan : '',
            'peternakan_perikanan' => ($model->penggunaan_tanah == 'Ternak / Tambak / Kolam') ? $model->luas_penggunaan : '',
            'hutan_belukar'   => ($model->penggunaan_tanah == 'Hutan Belukar') ? $model->luas_penggunaan : '',
            'hutan_lebat'     => ($model->penggunaan_tanah == 'Hutan Lebat / Lindung') ? $model->luas_penggunaan : '',
            'mutasi'          => ($model->penggunaan_tanah == 'Mutasi Tanah Di Desa') ? $model->luas_penggunaan : '',
            'tanah_kosong'    => ($model->penggunaan_tanah == 'Tanah Kosong') ? $model->luas_penggunaan : '',
            'lain_lain'       => $model->lain,
            'keterangan'      => $model->keterangan,

            'status_tanah'          => $model->status_tanah,
            'luas_status_tanah'     => $model->luas_status,
            'penggunaan_tanah'      => $model->penggunaan_tanah,
            'luas_penggunaan_tanah' => $model->luas_penggunaan,
        ];
    }
}
