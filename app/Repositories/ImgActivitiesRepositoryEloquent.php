<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ImgActivitiesRepository;
use App\Entities\ImgActivities;
use App\Validators\ImgActivitiesValidator;

/**
 * Class ImgActivitiesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ImgActivitiesRepositoryEloquent extends BaseRepository implements ImgActivitiesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ImgActivities::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ImgActivitiesValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
