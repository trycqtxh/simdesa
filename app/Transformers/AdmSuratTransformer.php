<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\AdmSurat;

/**
 * Class AdmSuratTransformer
 * @package namespace App\Transformers;
 */
class AdmSuratTransformer extends TransformerAbstract
{

    /**
     * Transform the \AdmSurat entity
     * @param \AdmSurat $model
     *
     * @return array
     */
    public function transform(AdmSurat $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
