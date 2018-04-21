<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class LikeComment extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laravellikecomment_likes';

    /**
	 * Fillable array
     */
    protected $fillable = ['user_id', 'item_id', 'vote'];
}
