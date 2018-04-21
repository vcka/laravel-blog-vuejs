<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{            
	    $this->middleware('auth:admin');	    
	}


    public function index()
    {               
    	return view('admin/home');
    }
}
