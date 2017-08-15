<?php

namespace App\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Entities\LembarBeritaDesa;

/**
 * Class LembarBeritaDesaTransformer
 * @package namespace App\Transformers;
 */
class BeritaDesaTransformer extends TransformerAbstract
{

    /**
     * Transform the \LembarBeritaDesa entity
     * @param \LembarBeritaDesa $model
     *
     * @return array
     */
    public function transform(LembarBeritaDesa $model)
    {
        $peraturan = $model->peraturanDesaBerita;
        return [
            'id'                => (int) $model->id,
            'jenis_peraturan'   => $model->peraturanDesaBerita->jenis_peraturan,
            'ditetapkan'        => $model->peraturanDesaBerita->nomor_ditetapkan.'/'.Carbon::parse($model->peraturanDesaBerita->tanggal_ditetapkan)->format('d-m-Y'),
            'tentang'           => $model->peraturanDesaBerita->tentang,
            'nomor_diundangkan' => $model->nomor_diundangkan,
            'tanggal_diundangkan' => Carbon::parse($model->tanggal_diundangkan)->format('d-m-Y'),
            'keterangan'         => $model->keterangan
        ];
    }
}
