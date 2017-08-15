<?php

namespace App\Transformers;

use App\Entities\PendudukInduk;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

/**
 * Class IndukSelectAparatTransformer
 * @package namespace App\Transformers;
 */
class IndukSelectAparatTransformer extends TransformerAbstract
{

    /**
     * Transform the \IndukSelectAparat entity
     * @param \IndukSelectAparat $model
     *
     * @return array
     */
    public function transform(PendudukInduk $model)
    {
        return [
            'nik' => $model->nik,
            'nama' => $model->nik,
            'jenis_kelamin' => ($model->penduduk->jenis_kelamin == "L") ? "Laki-laki": "Perempuan",
            'tempat_lahir' => $model->penduduk->tempat_lahir,
            'tanggal_lahir' => Carbon::parse($model->penduduk->tanggal_lahir)->format('d-m-Y'),
            'agama' => $model->agama,
            'pendidikan' => $model->pendidikan,
        ];
    }
}
