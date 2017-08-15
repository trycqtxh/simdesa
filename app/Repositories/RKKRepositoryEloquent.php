<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RKKRepository;
use App\Entities\RKK;
use App\Validators\RKKValidator;

/**
 * Class RKKRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RKKRepositoryEloquent extends BaseRepository implements RKKRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RKK::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RKKValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
