<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SlidesRepository;
use App\Entities\Slides;

/**
 * Class SlidesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SlidesRepositoryEloquent extends BaseRepository implements SlidesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Slides::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
