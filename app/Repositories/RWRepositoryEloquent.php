<?php

namespace App\Repositories;

use App\Presenters\RWPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RWRepository;
use App\Entities\RW;
use App\Validators\RWValidator;

/**
 * Class RWRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RWRepositoryEloquent extends BaseRepository implements RWRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RW::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RWValidator::class;
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
        return RWPresenter::class;
    }
}
