<?php

namespace App\Criteria;

use Carbon\Carbon;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PemiluCriteria
 * @package namespace App\Criteria;
 */
class PemiluCriteria implements CriteriaInterface
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
        $awal = Carbon::today()->subYear(17)->toDateString();
        return $model->where('tanggal_lahir', '<=', $awal);
    }
}
