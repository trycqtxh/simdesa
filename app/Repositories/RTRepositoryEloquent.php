<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RTRepository;
use App\Entities\RT;
use App\Validators\RTValidator;
use App\Presenters\RTPresenter;

/**
 * Class RTRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RTRepositoryEloquent extends BaseRepository implements RTRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RT::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RTValidator::class;
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
        return RTPresenter::class;
    }
}
