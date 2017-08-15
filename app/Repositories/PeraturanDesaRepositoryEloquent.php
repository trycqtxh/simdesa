<?php

namespace App\Repositories;

use App\Presenters\PeraturanDesaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PeraturanDesaRepository;
use App\Entities\PeraturanDesa;
use App\Validators\PeraturanDesaValidator;

/**
 * Class PeraturanDesaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PeraturanDesaRepositoryEloquent extends BaseRepository implements PeraturanDesaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PeraturanDesa::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PeraturanDesaValidator::class;
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
        return PeraturanDesaPresenter::class;
    }
}
