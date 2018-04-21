<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laravellikecomment_comments';

    /**
     * Fillable array
     */
    protected $fillable = ['user_id', 'parent_id', 'item_id', 'comment'];
    protected $hidden = [
        'user_id'
    ];

    //each category might have multiple children
    public function children() {
        return $this->hasMany(static::class, 'parent_id')->orderBy('created_at', 'desc')->with(['user', 'totalLikes', 'totalDislikes']);
    }

    public function user() {
        return $this->belongsTo(\App\Model\user\User::class, 'user_id')->select('id', 'name');
    }

    public function totalLikes() {
        return $this->belongsTo(TotalLike::class, 'id', 'item_id')->select('item_id', 'total_like');
    }

    public function totalDislikes() {
        return $this->belongsTo(TotalLike::class, 'id', 'item_id')->select('item_id', 'total_dislike');
    }

}