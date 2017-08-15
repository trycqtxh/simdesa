<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PendudukIndukRepository;
use App\Entities\PendudukInduk;
use App\Validators\PendudukIndukValidator;

/**
 * Class PendudukIndukRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PendudukIndukRepositoryEloquent extends BaseRepository implements PendudukIndukRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PendudukInduk::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PendudukIndukValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
