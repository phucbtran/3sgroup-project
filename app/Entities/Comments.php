<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Comments.
 *
 * @package namespace App\Entities;
 */
class Comments extends Model implements Transformable
{
    use SoftDeletes;
    use TransformableTrait;

    protected $table = 'comments';

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
        'post_id',
        'type_cmt_flg',
        'content',
        'status',

        'deleted_at',
        'created_at',
        'updated_at',
        'user_id'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'post_id');
    }
}
