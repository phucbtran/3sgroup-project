<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoriesRepository;
use App\Entities\Categories;

/**
 * Class CategoriesRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoriesRepositoryEloquent extends BaseRepository implements CategoriesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Categories::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getListCategory() {
        $query = DB::table('categories as c1')
            ->select('c1.id as id1', 'c2.id as id2', 'c3.id as id3')
            ->leftJoin('categories as c2', function ($join) {
                $join->on('c1.cat_parent_id', '=', 'c2.id');
            })
            ->leftJoin('categories as c3', function ($join) {
                $join->on('c2.cat_parent_id', '=', 'c3.id');
            })
            ->orderBy('c1.group_id', 'ASC')
            ->orderBy('c1.num_sort', 'ASC')
//            ->get()
        ;
        dd($query->toSql());
        return $query;
    }

}
