<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ContactsRepository;
use App\Entities\Contacts;

/**
 * Class ContactsRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ContactsRepositoryEloquent extends BaseRepository implements ContactsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Contacts::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getListContacts() {
        $query = Contacts::select('*')
            ->orderBy('created_at', 'DESC')
            ->get();
        return $query;
    }

    public function deleteList($listId) {
        $query = Contacts::whereIn('id', $listId)
            ->delete();
        return $query;
    }

}
