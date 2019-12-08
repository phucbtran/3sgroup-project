<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CommentsRepository.
 *
 * @package namespace App\Repositories;
 */
interface CommentsRepository extends RepositoryInterface
{
    public function getListComment($typeComment);

    public function deleteList($listId);
}
