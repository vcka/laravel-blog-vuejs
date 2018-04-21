<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Closure;

/**
 * Description of BeforeAnyDbQuery
 *
 * @author Vivek.Chaudhary
 */
class BeforeAnyDbQuery {

    public function handle($request, Closure $next) {
        DB::flushQueryLog();
        DB::enableQueryLog();
        return $next($request);
    }

    public function terminate($request, $response) {
        // Store or dump the log data...
        dd(DB::getQueryLog());
    }

}
