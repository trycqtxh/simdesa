<?php

namespace App\Repositories;

use App\Presenters\RKPPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RKPRepository;
use App\Entities\RKP;
use App\Validators\RKPValidator;

/**
 * Class RKPRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RKPRepositoryEloquent extends BaseRepository implements RKPRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RKP::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RKPValidator::class;
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
        return RKPPresenter::class;
    }
}
