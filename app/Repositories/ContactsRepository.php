<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ContactsRepository.
 *
 * @package namespace App\Repositories;
 */
interface ContactsRepository extends RepositoryInterface
{
    // get list contact
    public function getListContacts();

    public function deleteList($listId);
}
