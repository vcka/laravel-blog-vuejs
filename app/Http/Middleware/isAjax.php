<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class isAjax {

    /**
     * Display a listing of the resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Response
     */
    public function handle($request, Closure $next) {
        /* echo $request->session()->token();
        echo '<br/>';
        echo $request->headers->get('X-CSRF-Token');
        die;*/
        if ($request->ajax()) {
            return $next($request);
            /* if (Session::token() === $request->headers->get('X-CSRF-Token')) {
              return $next($request);
              } else {
              return response()->json(['use the app with valid token.']);
              } */
        } else {
            return response()->json(['use the app']);
        }
    }

}
