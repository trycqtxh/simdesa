<?php

namespace App\Repositories;

use App\Presenters\LembarBeritaDesaPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LembarBeritaDesaRepository;
use App\Entities\LembarBeritaDesa;
use App\Validators\LembarBeritaDesaValidator;

/**
 * Class LembarBeritaDesaRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LembarBeritaDesaRepositoryEloquent extends BaseRepository implements LembarBeritaDesaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LembarBeritaDesa::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
