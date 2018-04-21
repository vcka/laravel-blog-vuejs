<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    public function page() {
        return $this->belongsTo('App\Model\admin\Page');
    }
    
    public function role() {
        return $this->belongsTo('App\Model\admin\Role');
    }
    
    public function roles() {
        return $this->belongsToMany('App\Model\admin\Role');
    }
    
   /* public function pages() {
        return $this->hasMany('App\Model\admin\MethodPage');
    }
    
    /*public function pages() {
        return $this->hasMany('App\Model\admin\MethodPage')->with('page');
    }
    
    public function methodpages() {
        return $this->hasMany('App\Model\admin\PageMethodRole')->with('methodpage');
    }*/
    
}
