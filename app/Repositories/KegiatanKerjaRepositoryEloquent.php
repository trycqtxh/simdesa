<?php

namespace App\Repositories;

use App\Presenters\KegiatanKerjaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\KegiatanKerjaRepository;
use App\Entities\KegiatanKerja;
use App\Validators\KegiatanKerjaValidator;

/**
 * Class KegiatanKerjaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class KegiatanKerjaRepositoryEloquent extends BaseRepository implements KegiatanKerjaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return KegiatanKerja::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return KegiatanKerjaValidator::class;
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
        return KegiatanKerjaPresenter::class;
    }
}
