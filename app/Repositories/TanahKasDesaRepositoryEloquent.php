<?php

namespace App\Repositories;

use App\Presenters\TanahKasDesaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TanahKasDesaRepository;
use App\Entities\TanahKasDesa;
use App\Validators\TanahKasDesaValidator;

/**
 * Class TanahKasDesaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class TanahKasDesaRepositoryEloquent extends BaseRepository implements TanahKasDesaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TanahKasDesa::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TanahKasDesaValidator::class;
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
        return TanahKasDesaPresenter::class;
    }
}
