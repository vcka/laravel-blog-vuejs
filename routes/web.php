<?php

//Admin Routes
Route::group(['namespace' => 'Admin', 'guard' => 'admin'], function() {
    if (isset($_GET['sql']) && $_GET['sql'] === 'print') {
        \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
            echo'<pre>';
            var_dump($query->sql);
            var_dump($query->bindings);
            var_dump($query->time);
            echo'</pre>';
        });
    }

    Route::get('admin/home', 'HomeController@index')->name('admin.home');
    Route::group(['middleware' => ['rolebased']], function () {
        // Users Routes
        Route::resource('admin/user', 'UserController');
        // Roles Routes
        Route::resource('admin/role', 'RoleController');
        // Permission Routes
        Route::resource('admin/permission', 'PermissionController');
        // Post Routes
        Route::resource('admin/post', 'PostController');
        // Tag Routes
        Route::resource('admin/tag', 'TagController');
        // Category Routes
        Route::resource('admin/category', 'CategoryController');
        // Controller Relation Routes
        Route::resource('admin/page', 'PageController');
        // Action Relation Routes
        Route::resource('admin/method', 'MethodController');
        // Comment Routes
        Route::resource('admin/comment', 'CommentController');
        Route::post('admin/approved', 'CommentController@approveComment');

        //JQGRID DATA        
        Route::get('get-post-data', 'PostController@getPostData')->name('post.data');
        Route::get('get-category-data', 'CategoryController@getData')->name('category.data');
        Route::get('get-user-data', 'UserController@getData')->name('user.data');
        Route::get('get-comment-data', 'CommentController@getData')->name('comment.data');
        Route::get('get-role-data', 'RoleController@getData')->name('role.data');
        Route::get('get-page-data', 'PageController@getData')->name('page.data');
        Route::get('get-method-data', 'MethodController@getData')->name('method.data');
    });

    // Controller Relation Routes
    Route::resource('admin/user-profile', 'ProfileController');

    // Admin Auth Routes
    Route::get('admin', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('admin-logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::post('admin-login', 'Auth\LoginController@login');
});

// User Routes
Route::group(['namespace' => 'User', 'guard' => 'user'], function() {
    if (1) {
        Route::get('{path}', function () {
            return view('user.welcome');
        })->where('path', '(.*)');
    } else {
        Route::get('/', 'HomeController@index');
        Route::get('/home', 'HomeController@index');
        Route::get('/index', 'HomeController@index');

        Route::get('post/{post}', 'PostController@post')->name('post');

        Route::get('post/tag/{tag}', 'HomeController@tag')->name('tag');
        Route::get('post/category/{category}', 'HomeController@category')->name('category');

        Route::get('contact', 'ContactController@create')->name('contact.create');
        Route::post('contact', 'ContactController@store')->name('contact.store');

        Route::get('recent-post', 'RecentPostController@index')->name('recentpost.index');

        Route::get('archive', 'ArchivePostController@index')->name('archive.index');
        Route::get('archive/{year}', 'ArchivePostController@getPostByYear')->name('archive.postbyyear');
        Route::get('archive/{year}/{month}', 'ArchivePostController@getPostByYearMonth')->name('archive.postbyyearmonth');
        //Route::get('demo', 'HomeController@showDemo')->name('home.demo');
        //vue routes
        Route::post('getPosts', 'PostController@getAllPosts');
        Route::post('saveLike', 'PostController@saveLike');
        Route::post('addComment', 'PostController@addComment');
        Route::post('commentlike', 'PostController@saveCommentLike');
        Route::post('commentreply', 'PostController@saveCommentReply');
    }
});

Auth::routes();
