<?php

namespace App\Repositories;

use App\Presenters\PekerjaanPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PekerjaanRepository;
use App\Entities\Pekerjaan;
use App\Validators\PekerjaanValidator;

/**
 * Class PekerjaanRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PekerjaanRepositoryEloquent extends BaseRepository implements PekerjaanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pekerjaan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PekerjaanValidator::class;
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
        return PekerjaanPresenter::class;
    }
}
