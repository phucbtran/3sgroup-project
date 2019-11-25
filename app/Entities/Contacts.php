<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Contacts.
 *
 * @package namespace App\Entities;
 */
class Contacts extends Model implements Transformable
{
    use SoftDeletes;
    use TransformableTrait;

    protected $table = 'contacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'full_name',
        'email',
        'phone',
        'title',
        'content',

        'deleted_at',
        'created_at',
        'updated_at',
        'user_id'
    ];

}
