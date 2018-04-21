<?php

namespace App\Model\admin;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function methods() {
        return $this->hasMany('App\Model\admin\Method');
    }
    
    /*public function methods() {
        return $this->hasMany('App\Model\admin\MethodPage')->with('method');
    }
    
    public function methodpages() {
        return $this->hasMany('App\Model\admin\PageMethodRole')->with('methodpage');
    }*/
}
