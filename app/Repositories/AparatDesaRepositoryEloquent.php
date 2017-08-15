<?php

namespace App\Repositories;

use App\Presenters\AparatDesaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AparatDesaRepository;
use App\Entities\AparatDesa;
use App\Validators\AparatDesaValidator;

/**
 * Class AparatDesaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AparatDesaRepositoryEloquent extends BaseRepository implements AparatDesaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AparatDesa::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AparatDesaValidator::class;
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
        return AparatDesaPresenter::class;
    }
}
