<?php

namespace App\Criteria;

use Carbon\Carbon;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class BalitaCriteria
 * @package namespace App\Criteria;
 */
class BalitaCriteria implements CriteriaInterface
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
        $akhir = Carbon::today()->toDateString();
        $awal = Carbon::today()->subYears(5)->toDateString();
        return $model->whereBetween('tanggal_lahir', [$awal, $akhir]);
    }
}
