<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PendudukSementaraRepository;
use App\Entities\PendudukSementara;
use App\Validators\PendudukSementaraValidator;

/**
 * Class PendudukSementaraRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PendudukSementaraRepositoryEloquent extends BaseRepository implements PendudukSementaraRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PendudukSementara::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PendudukSementaraValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
