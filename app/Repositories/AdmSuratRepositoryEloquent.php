<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AdmSuratRepository;
use App\Entities\AdmSurat;
use App\Validators\AdmSuratValidator;

/**
 * Class AdmSuratRepositoryEloquent
 * @package namespace App\Repositories;
 */
class AdmSuratRepositoryEloquent extends BaseRepository implements AdmSuratRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AdmSurat::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return AdmSuratValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
