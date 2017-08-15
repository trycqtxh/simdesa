<?php

namespace App\Repositories;

use App\Presenters\SumberDanaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SumberDanaRepository;
use App\Entities\SumberDana;
use App\Validators\SumberDanaValidator;

/**
 * Class SumberDanaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SumberDanaRepositoryEloquent extends BaseRepository implements SumberDanaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SumberDana::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SumberDanaValidator::class;
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
        return SumberDanaPresenter::class;
    }
}
