<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class tag extends Model {

    public function posts() {
        return $this->belongsToMany('App\Model\user\post', 'post_tags')->with('posted_by')->orderBy('created_at', 'DESC')->paginate(5);
    }

    public function getRouteKeyName() {
        return 'slug';
    }

    public function getTagCountByUserId($id) {
        $userId = (int) $id;
        return self::where(['posted_by' => $userId])->count();
    }

}
