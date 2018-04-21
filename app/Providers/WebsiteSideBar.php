<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class WebsiteSideBar extends ServiceProvider {

    public function boot() {
        //View::composer('user.*', 'App\Http\ViewComposers\CategoriesComposer');
        //View::composer('user.*', 'App\Http\ViewComposers\ArchieveComposer');
        //View::composer('user.*', 'App\Http\ViewComposers\TagsComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
