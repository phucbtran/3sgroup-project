<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Roles.
 *
 * @package namespace App\Entities;
 */
class Roles extends Model implements Transformable
{
    use SoftDeletes;
    use TransformableTrait;

    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',

        'deleted_at',
        'created_at',
        'updated_at',
        'user_id'
    ];

}
