<?php

namespace App\Repositories;

use App\Presenters\BidangPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BidangRepository;
use App\Entities\Bidang;
use App\Validators\BidangValidator;

/**
 * Class BidangRepositoryEloquent
 * @package namespace App\Repositories;
 */
class BidangRepositoryEloquent extends BaseRepository implements BidangRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Bidang::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BidangValidator::class;
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
        return BidangPresenter::class;
    }
}
