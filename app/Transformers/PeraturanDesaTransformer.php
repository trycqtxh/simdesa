<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\PeraturanDesa;

/**
 * Class PeraturanDesaTransformer
 * @package namespace App\Transformers;
 */
class PeraturanDesaTransformer extends TransformerAbstract
{

    /**
     * Transform the \PeraturanDesa entity
     * @param \PeraturanDesa $model
     *
     * @return array
     */
    public function transform(PeraturanDesa $model)
    {
        return [
            'id'                   => (int) $model->id,
            'jenis_peraturan'      => $model->jenis_peraturan,
            'ditetapkan'           => $model->nomor_ditetapkan.'/'.Carbon::parse($model->tanggal_ditetapkan)->format('d-m-Y'),
            'tentang'              => $model->tentang,
            'uraian'               => $model->uraian,
            'kesepakatan'          => ($model->nomor_kesepakatan) ? ($model->nomor_kesepakatan.'/'.Carbon::parse($model->tanggal_kesepakatan)->format('d-m-Y')) : '',
            'dilaporan'            => $model->nomor_laporan.'/'.Carbon::parse($model->tanggal_laporan)->format('d-m-Y'),
            'diundangkan_lembaran' => ($model->berita)? $model->berita->nomor_diundangkan.'/'.Carbon::parse($model->berita->tanggal_diundangkan)->format('d-m-Y'): '',
            'diundangkan_berita'   => ($model->berita)? $model->berita->nomor_diundangkan.'/'.Carbon::parse($model->berita->tanggal_diundangkan)->format('d-m-Y'): '',
            'keterangan'           => $model->keterangan
        ];
    }
}
