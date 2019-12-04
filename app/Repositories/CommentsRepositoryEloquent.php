<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CommentsRepository;
use App\Entities\Comments;

/**
 * Class CommentsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CommentsRepositoryEloquent extends BaseRepository implements CommentsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comments::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getListComment($typeComment) {
        $query = Comments::select('*')
            ->where('type_cmt_flg', $typeComment)
            ->orderBy('created_at', 'DESC')
            ->get();
        return $query;
    }
}
