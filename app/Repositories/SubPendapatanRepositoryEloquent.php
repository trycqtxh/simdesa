<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SubPendapatanRepository;
use App\Entities\SubPendapatan;
use App\Validators\SubPendapatanValidator;

/**
 * Class SubPendapatanRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SubPendapatanRepositoryEloquent extends BaseRepository implements SubPendapatanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SubPendapatan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SubPendapatanValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
