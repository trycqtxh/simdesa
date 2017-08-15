<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class IndukKepalaKeluargaCriteria
 * @package namespace App\Criteria;
 */
class IndukKepalaKeluargaCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param                     $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        return $model->whereHas('statusKeluarga', function($q){
            $q->where('kode', 'KK');
        })->has('anggotaKeluarga');
    }
}
