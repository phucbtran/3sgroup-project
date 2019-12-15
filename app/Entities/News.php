<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class News.
 *
 * @package namespace App\Entities;
 */
class News extends Model implements Transformable
{
    use SoftDeletes;
    use TransformableTrait;

    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title_name',
        'slug',
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
