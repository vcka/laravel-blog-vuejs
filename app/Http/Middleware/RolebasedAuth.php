<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Router;
use App\Model\admin\admin as AdminUser;
use Illuminate\Support\Facades\Route;

class RolebasedAuth {

    protected $router;
    protected $adminUser;

    public function __construct(Router $router, AdminUser $adminUser) {
        $this->router = $router;
        $this->adminUser = $adminUser;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        /* $controllers = [];

          foreach (Route::getRoutes()->getRoutes() as $route) {
          $action = $route->getAction();

          if (array_key_exists('controller', $action)) {
          // You can also use explode('@', $action['controller']); here
          // to separate the class name from the method
          //$controllers[] = $action['controller'];
          $explodeCon = explode('\\', $action['controller']);

          if ($explodeCon[3] == 'Admin') {
          $controllerAction = explode('Controller@', array_last($explodeCon));
          $controllers[strtolower($controllerAction[0])][] = strtolower($controllerAction[1]);
          }
          }
          }
          dd($controllers); */
        
        $controllerClass = $this->router->getRoutes()->match($request)->getActionName();
        $controllerAction = explode('Controller@', array_last(explode('\\', $controllerClass)));

        $controllerName = strtolower($controllerAction[0]);
        $actionName = strtolower($controllerAction[1]);
        $controllers = session('permission'); //$this->adminUser->getAssignedControllerAction();
        if (0) {
            echo $controllerName . '<br/>' . $actionName;
            echo '<br/> Cont : ';
            var_dump(!empty($controllers[$controllerName][$actionName]));
            dd($controllers);
        }
        if (!empty($controllers[$controllerName][$actionName])) {
            return $next($request);
        } else {
            return redirect(route('admin.home'))->with('Here Not Authorized!');
        }
    }

}
