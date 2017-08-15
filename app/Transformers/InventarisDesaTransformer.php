<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\InventarisDesa;

/**
 * Class InventarisDesaTransformer
 * @package namespace App\Transformers;
 */
class InventarisDesaTransformer extends TransformerAbstract
{

    /**
     * Transform the \InventarisDesa entity
     * @param \InventarisDesa $model
     *
     * @return array
     */
    public function transform(InventarisDesa $model)
    {
        return [
            'id'         => (int) $model->id,
            'jenis_barang' => $model->jenis_barang,
            'asal_sendiri' => $model->asal_sendiri,
            'asal_pemerintah' => $model->asal_pemerintah,
            'asal_provinsi' => $model->asal_provinsi,
            'asal_kota' => $model->asal_kota,
            'asal_sumbangan' => $model->asal_sumbangan,
            'awal_tahun_baik' => $model->awal_tahun_baik,
            'awal_tahun_rusak' => $model->awal_tahun_rusak,
            'hapus_rusak' => $model->hapus_rusak,
            'hapus_dijual' => $model->hapus_dijual,
            'hapus_disumbangkan' => $model->hapus_disumbangkan,
            'hapus_tanggal' => $model->hapus_tanggal,
            'akhir_tahun_baik' => $model->akhir_tahun_baik,
            'akhir_tahun_rusak' => $model->akhir_tahun_rusak,
            'keterangan' => $model->keterangan,
        ];
    }
}
