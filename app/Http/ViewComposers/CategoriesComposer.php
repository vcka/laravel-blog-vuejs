<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class CategoriesComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $_categories;

    public function __construct() {        
        $this->_categories = \App\Model\user\category_post::select('categories.name', 'categories.slug', \DB::raw('COUNT(category_posts.category_id) as post_count'))->groupBy('category_posts.category_id')
                ->join('categories', 'category_posts.category_id', '=', 'categories.id')
                ->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view) {
        $view->with('categories', $this->_categories);
    }

}
