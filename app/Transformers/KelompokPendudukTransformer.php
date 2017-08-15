<?php

namespace App\Transformers;

use App\Entities\Penduduk;
use League\Fractal\TransformerAbstract;

/**
 * Class KelompokPendudukTransformer
 * @package namespace App\Transformers;
 */
class KelompokPendudukTransformer extends TransformerAbstract
{

    /**
     * Transform the \KelompokPenduduk entity
     * @param \KelompokPenduduk $model
     *
     * @return array
     */
    public function transform(Penduduk $model)
    {
        return [
            'id'            => (int) $model->id,
            'nik'           => $model->pendudukInduks()->first()->nik,
            'nama'          => $model->nama,
            'jenis_kelamin' => $model->jenis_kelamin,
            'tempat_lahir'  => $model->tempat_lahir,
            'tanggal_lahir' => $model->tanggal_lahir,
        ];
    }
}
