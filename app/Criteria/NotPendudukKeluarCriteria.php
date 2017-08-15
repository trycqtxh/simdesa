<?php

namespace App\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class NotPendudukKeluarCriteria
 * @package namespace App\Criteria;
 */
class NotPendudukKeluarCriteria implements CriteriaInterface
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
        return $model->has('mutasiKeluars', '=', 0)->has('mutasiMatis', '=', 0);
    }
}
