<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DetailKegiatanKerjaRepository;
use App\Entities\DetailKegiatanKerja;
use App\Validators\DetailKegiatanKerjaValidator;

/**
 * Class DetailKegiatanKerjaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DetailKegiatanKerjaRepositoryEloquent extends BaseRepository implements DetailKegiatanKerjaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DetailKegiatanKerja::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DetailKegiatanKerjaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
