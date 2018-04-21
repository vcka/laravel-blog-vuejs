<?php

namespace App\Model\admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class admin extends Authenticatable {

    use Notifiable;   

    public function roles() {
        return $this->belongsToMany('App\Model\admin\role');
    }

    public function getNameAttribute($value) {
        return ucfirst($value);
    }

    public function getAdminAvatar() {
        return Storage::url(Auth::user()->profile_image);
    }

    public function getAssignedControllerAction($user = null) {
        if ($user == null) {
            $user = Auth::user();
        }
        $roleNames = $controllers = $actions = array();
        if ($user != null && $user->roles != null) {
            try {
                $roleNames = array();
                foreach ($user->roles as $role) {
                    foreach ($role->methods as $method) {
                        $controllers[$method->page->name][strtolower($method->name)] = strtolower($method->name);
                    }
                }
            } catch (Exception $ex) {
                
            }
        }
        return $controllers;
    }

    public function hasPermissionTo($value) {
        $controllers = session('permission');
        $explodeValue = explode('.', $value);
        $controllerName = $explodeValue[0];
        $actionName = $explodeValue[1];
        if (!empty($controllers[$controllerName][$actionName])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'id'
    ];

}
