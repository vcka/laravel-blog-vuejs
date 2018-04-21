<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\admin\admin as AdminUser;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Gate;

class RoleBasedAuth extends ServiceProvider {

    protected $router;
    protected $adminUser;
    protected $arguments;

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(Router $router, AdminUser $adminUser) {
        $this->adminUser = $adminUser;
        $this->router = $router;

        view()->composer('admin.*', function ($view) {
            $permission = session('permission');            
            $current_route_name = (\Request::route() !== null) ? \Request::route()->getName() : '';
            $activeMenu = $this->activeMenu($current_route_name);
            $view->with('activeMenu', $activeMenu);
            $menuShowController = array();
            if ($permission !== null) {
                $controllers = $permission; //session('permission'); //$this->adminUser->getAssignedControllerAction();
                foreach ($controllers as $controllersName => $controller) {
                    foreach ($controller as $action) {
                        $getRouteName = $controllersName . '.' . $action;
                        $checkActiveMenu = $this->activeMenu($getRouteName);
                        $menuShowController[$checkActiveMenu['parent']] = $checkActiveMenu['parent'];
                        //echo $getRouteName . '<br/>';
                        Gate::define($getRouteName, function($user, $getRouteName) {
                            return true;
                        });
                    }
                }
            }
            $view->with('menuController', $menuShowController);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    public
            function activeMenu($route) {
        $activeMenu = array();
        switch ($route) {
            case 'admin.home':
                $activeMenu['parent'] = 'dashboard';
                $activeMenu['child'] = 'dashboard';
                break;
            case 'post.index':
            case 'post.create':
            case 'post.edit':
                $activeMenu['parent'] = 'blog';
                $activeMenu['child'] = 'post';
                break;
            case 'category.index':
            case 'category.create':
            case 'category.edit':
                $activeMenu['parent'] = 'blog';
                $activeMenu['child'] = 'category';
                break;
            case 'tag.index':
            case 'tag.create':
            case 'tag.edit':
                $activeMenu['parent'] = 'blog';
                $activeMenu['child'] = 'tag';
                break;
            case 'user.index':
            case 'user.create':
            case 'user.edit':
                $activeMenu['parent'] = 'acl';
                $activeMenu['child'] = 'user';
                break;
            case 'role.index':
            case 'role.create':
            case 'role.edit':
                $activeMenu['parent'] = 'acl';
                $activeMenu['child'] = 'role';
                break;
            case 'permission.index':
            case 'permission.create':
            case 'permission.edit':
                $activeMenu['parent'] = 'acl';
                $activeMenu['child'] = 'permission';
                break;
            case 'page.index':
            case 'page.create':
            case 'page.edit':
                $activeMenu['parent'] = 'acl';
                $activeMenu['child'] = 'page';
                break;
            case 'method.index':
            case 'method.create':
            case 'method.edit':
                $activeMenu['parent'] = 'acl';
                $activeMenu['child'] = 'method';
                break;
            case 'comment.index':
                $activeMenu['parent'] = 'blog';
                $activeMenu['child'] = 'comment';
                break;
            default:
                $activeMenu['parent'] = 'dashboard';
                $activeMenu['child'] = 'dashboard';
                break;
        }
        return $activeMenu;
    }

}
