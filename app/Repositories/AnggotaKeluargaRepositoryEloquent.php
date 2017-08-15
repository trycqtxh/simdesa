<?php

namespace App\Repositories;

use App\Criteria\IndukKepalaKeluargaCriteria;
use App\Presenters\AnggotaKeluargaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AnggotaKeluargaRepository;
use App\Entities\AnggotaKeluarga;
use App\Validators\AnggotaKeluargaValidator;

/**
 * Class AnggotaKeluargaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AnggotaKeluargaRepositoryEloquent extends BaseRepository implements AnggotaKeluargaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AnggotaKeluarga::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AnggotaKeluargaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
//        $this->pushCriteria(IndukKepalaKeluargaCriteria::class);
    }

    public function presenter()
    {
        return AnggotaKeluargaPresenter::class;
    }
}
