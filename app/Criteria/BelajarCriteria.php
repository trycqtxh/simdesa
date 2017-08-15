<?php

namespace App\Criteria;

use Carbon\Carbon;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class BelajarCriteria
 * @package namespace App\Criteria;
 */
class BelajarCriteria implements CriteriaInterface
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
        $akhir = Carbon::today()->subYear(7)->toDateString();
        $awal = Carbon::today()->subYear(19)->toDateString();
        return $model->whereBetween('tanggal_lahir', [$awal, $akhir]);
    }
}
