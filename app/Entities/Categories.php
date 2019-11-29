<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Categories.
 *
 * @package namespace App\Entities;
 */
class Categories extends Model implements Transformable
{
    use SoftDeletes;
    use TransformableTrait;

    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'img_dir_path',
        'cat_parent_id',
        'num_sort',
        'status',

        'deleted_at',
        'created_at',
        'updated_at',
        'user_id'
    ];

}
