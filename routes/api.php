<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::post('login', 'API\AuthController@login');
Route::post('register', 'API\AuthController@register');
Route::post('fb-login', 'API\AuthController@fbLogin');
Route::post('gm-login', 'API\AuthController@gmLogin');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'User', 'guard' => 'api'], function() {
    //vue routes
    //->middleware('query.log')
    // Post Controller
    Route::group(['middleware' => ['check.ajax']], function() {
        Route::get('get-posts', 'PostController@getAllPosts');
        Route::get('get-post-details/{slug}', 'PostController@postDetails');
        Route::get('get-category-posts/{category}', 'PostController@postCategoryDetails');
        Route::get('get-tag-posts/{tag}', 'PostController@postTagDetails');
        Route::get('get-post-comments/{id}', 'PostController@postComments');

        // SideBar Controller
        Route::get('get-sidebar', 'SidebarController@getSideBar');

        // Archive Controller
        Route::get('get-post-by-year/{year}', 'ArchivePostController@getPostByYearJson');
        Route::get('get-post-by-month/{year}/{month}', 'ArchivePostController@getPostByMonthJson');

        Route::group(['middleware' => ['jwt.auth']], function() {
            Route::post('add-comments', 'CommentController@add');
            Route::post('vote', 'LikeController@vote');
            Route::post('like', 'PostController@saveLike');
            Route::get('profile', 'UserController@profile');
        });
    });
});
