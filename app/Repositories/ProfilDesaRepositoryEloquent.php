<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProfilDesaRepository;
use App\Entities\ProfilDesa;
use App\Validators\ProfilDesaValidator;

/**
 * Class ProfilDesaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProfilDesaRepositoryEloquent extends BaseRepository implements ProfilDesaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProfilDesa::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ProfilDesaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
