<?php

namespace App\Repositories;

use App\Presenters\PembiayaanPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PembiayaanRepository;
use App\Entities\Pembiayaan;
use App\Validators\PembiayaanValidator;

/**
 * Class PembiayaanRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PembiayaanRepositoryEloquent extends BaseRepository implements PembiayaanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Pembiayaan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PembiayaanValidator::class;
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
        return PembiayaanPresenter::class;
    }
}
