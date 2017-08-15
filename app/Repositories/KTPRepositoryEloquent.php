<?php

namespace App\Repositories;

use App\Presenters\KTPPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\KTPRepository;
use App\Entities\KTP;
use App\Validators\KTPValidator;

/**
 * Class KTPRepositoryEloquent
 * @package namespace App\Repositories;
 */
class KTPRepositoryEloquent extends BaseRepository implements KTPRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return KTP::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return KTPValidator::class;
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
        return KTPPresenter::class;
    }
}
