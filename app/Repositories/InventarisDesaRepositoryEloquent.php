<?php

namespace App\Repositories;

use App\Presenters\InventarisDesaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InventarisDesaRepository;
use App\Entities\InventarisDesa;
use App\Validators\InventarisDesaValidator;

/**
 * Class InventarisDesaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class InventarisDesaRepositoryEloquent extends BaseRepository implements InventarisDesaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InventarisDesa::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return InventarisDesaValidator::class;
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
        return InventarisDesaPresenter::class;
    }
}
