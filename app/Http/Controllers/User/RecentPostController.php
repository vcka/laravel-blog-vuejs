<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\post;

class RecentPostController extends Controller {

    public function index() {
        $posts = post::with('likes')->orderBy('created_at', 'desc')->take(10)->get();
        return view('user.blog', compact('posts'));
    }

}
