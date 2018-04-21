<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class category extends Model {

    protected $hidden = [
        'id'
    ];

    public function posts() {
        return $this->belongsToMany(post::class, 'category_posts')->orderBy('created_at', 'DESC')->with(['posted_by'])->paginate(5);
    }

    public function getRouteKeyName() {        
        return 'slug';
    }

}
