<?php

namespace App\Repositories;

use App\Presenters\StatusKeluargaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\StatusKeluargaRepository;
use App\Entities\StatusKeluarga;
use App\Validators\StatusKeluargaValidator;

/**
 * Class StatusKeluargaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class StatusKeluargaRepositoryEloquent extends BaseRepository implements StatusKeluargaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return StatusKeluarga::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return StatusKeluargaValidator::class;
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
        return StatusKeluargaPresenter::class;
    }
}
