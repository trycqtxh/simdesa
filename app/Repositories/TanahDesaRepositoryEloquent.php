<?php

namespace App\Repositories;

use App\Presenters\TanahDesaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TanahDesaRepository;
use App\Entities\TanahDesa;
use App\Validators\TanahDesaValidator;

/**
 * Class TanahDesaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TanahDesaRepositoryEloquent extends BaseRepository implements TanahDesaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TanahDesa::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TanahDesaValidator::class;
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
        return TanahDesaPresenter::class;
    }
}
