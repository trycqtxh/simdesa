<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\SuratMenyurat;

/**
 * Class SuratMenyuratTransformer
 * @package namespace App\Transformers;
 */
class SuratMenyuratTransformer extends TransformerAbstract
{

    /**
     * Transform the \SuratMenyurat entity
     * @param \SuratMenyurat $model
     *
     * @return array
     */
    public function transform(SuratMenyurat $model)
    {
        return [
            'id'            => (int) $model->id,
            'tanggal_surat' => $model->tanggal_surat,
            'nomor_surat'   => $model->nomor_surat,
            'jenis_surat'   => $model->jenis_surat,
            'pemohon'       => $model->pemohon,
            'url'           => '<a href="'.route('surat.download', $model->url).'" class="btn btn-default btn-sm"><i class="fa fa-download"></i></a>',
        ];
    }
}
