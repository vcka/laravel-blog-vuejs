<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class TotalLike extends Model
{
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laravellikecomment_total_likes';

    /**
	 * Fillable array
     */
    protected $fillable = [];
    
    protected $hidden = [];
}
