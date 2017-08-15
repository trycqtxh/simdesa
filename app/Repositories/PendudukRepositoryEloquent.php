<?php

namespace App\Repositories;

use App\Criteria\NotPendudukKeluarCriteria;
use App\Criteria\NotPendudukSementaraCriteria;
use App\Criteria\PendudukIndukCriteria;
use App\Presenters\PendudukIndukPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PendudukRepository;
use App\Entities\Penduduk;
use App\Validators\PendudukValidator;

/**
 * Class PendudukRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PendudukRepositoryEloquent extends BaseRepository implements PendudukRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Penduduk::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PendudukValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
        $this->pushCriteria(NotPendudukKeluarCriteria::class);
        $this->pushCriteria(NotPendudukSementaraCriteria::class);
        $this->pushCriteria(PendudukIndukCriteria::class);
    }

    public function presenter()
    {
        return PendudukIndukPresenter::class;
    }
}
