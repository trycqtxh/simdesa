<?php

namespace App\Repositories;

use App\Presenters\JabatanPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\JabatanRepository;
use App\Entities\Jabatan;
use App\Validators\JabatanValidator;

/**
 * Class JabatanRepositoryEloquent
 * @package namespace App\Repositories;
 */
class JabatanRepositoryEloquent extends BaseRepository implements JabatanRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Jabatan::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return JabatanValidator::class;
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
        return JabatanPresenter::class;
    }
}
