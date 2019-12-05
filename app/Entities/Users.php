<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Users.
 *
 * @package namespace App\Entities;
 */
class Users extends Model implements Transformable
{
    use SoftDeletes;
    use TransformableTrait;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'password',
        'full_name',
        'role',
        'status',

        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $hidden = ['password'];
}
