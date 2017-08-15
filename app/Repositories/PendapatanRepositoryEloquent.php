<?php

namespace App\Repositories;

use App\Presenters\PendapatanPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PendapatanRepository;
use App\Entities\Pendapatan;
use App\Validators\PendapatanValidator;

/**
 * Class PendapatanRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PendapatanRepositoryEloquent extends BaseRepository implements PendapatanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pendapatan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PendapatanValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return PendapatanPresenter::class;
    }
}
