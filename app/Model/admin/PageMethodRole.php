<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class PageMethodRole extends Model
{
    public function methodpage() {
        return $this->belongsTo('App\Model\admin\MethodPage');
    }
}
