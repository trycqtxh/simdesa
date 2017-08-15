<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RPJMRepository;
use App\Entities\RPJM;
use App\Validators\RPJMValidator;

/**
 * Class RPJMRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RPJMRepositoryEloquent extends BaseRepository implements RPJMRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RPJM::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RPJMValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
