<?php

namespace App\Repositories;

use App\Presenters\SuratMenyuratPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SuratMenyuratRepository;
use App\Entities\SuratMenyurat;
use App\Validators\SuratMenyuratValidator;

/**
 * Class SuratMenyuratRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SuratMenyuratRepositoryEloquent extends BaseRepository implements SuratMenyuratRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SuratMenyurat::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SuratMenyuratValidator::class;
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
        return SuratMenyuratPresenter::class;
    }
}
