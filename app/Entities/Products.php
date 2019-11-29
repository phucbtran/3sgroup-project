<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Products.
 *
 * @package namespace App\Entities;
 */
class Products extends Model implements Transformable
{
    use SoftDeletes;
    use TransformableTrait;

    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'category_id',
        'img_dir_path',
        'meta_title',
        'content',
        'num_sort',
        'status',

        'deleted_at',
        'created_at',
        'updated_at',
        'user_id'
    ];

    protected $hidden = ['password'];


}
