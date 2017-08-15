<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PendudukMutasiRepository;
use App\Entities\PendudukMutasi;
use App\Validators\PendudukMutasiValidator;

/**
 * Class PendudukMutasiRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PendudukMutasiRepositoryEloquent extends BaseRepository implements PendudukMutasiRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PendudukMutasi::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PendudukMutasiValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
