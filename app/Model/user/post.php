<?php

namespace App\Model\user;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Model\admin\admin;

class post extends Model {

    protected $hidden = [
            //'id'
    ];
    
    public function post($slug) {
        return self::with(['likes', 'posted_by', 'categories', 'tags', 'comments'])
                        ->select(['title', 'subtitle', 'posted_by', 'slug', 'body', 'image', 'like', 'dislike', 'created_at', 'updated_at', 'id'])
                        ->where(['slug' => $slug, 'status' => 1]);
    }


    public function tags() {
        return $this->belongsToMany(tag::class, 'post_tags')->withTimestamps();
    }

    public function categories() {
        return $this->belongsToMany(category::class, 'category_posts')->withTimestamps();
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->diffForHumans();
    }

    public function likes() {
        return $this->hasMany(like::class);
    }

    public function posted_by() {
        return $this->belongsTo(admin::class, 'posted_by', 'id')->select(array('id', 'name'));
    }

    public function comments() {
        $collect = $this->hasMany(Comment::class, 'item_id', 'id')
                ->where(array('approved' => 1, 'parent_id' => 0))
                ->orderBy('created_at', 'desc')
                ->select(array('id', 'comment', 'parent_id', 'item_id', 'user_id', 'created_at'))
                ->with(['children', 'user', 'totalLikes', 'totalDislikes']);
        return $collect;
    }

    public function getPostCountByUserId($id) {
        $userId = (int) $id;
        return self::where(['posted_by' => $userId])->count();
    }

}
