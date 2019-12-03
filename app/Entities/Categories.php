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
        'group_id',
        'cat_parent_id',
        'num_sort',
        'status',

        'deleted_at',
        'created_at',
        'updated_at',
        'user_id'
    ];

    public function children()
    {
        return $this->hasMany(Categories::class, 'cat_parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Categories::class, 'cat_parent_id');
    }
}
