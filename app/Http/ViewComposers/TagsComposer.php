<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class TagsComposer {

    protected $_tags;

    public function __construct() {
        $this->_tags = \App\Model\user\post_tag::select('tags.name', 'tags.slug', \DB::raw('COUNT(post_tags.tag_id) as post_count'))->groupBy('post_tags.tag_id')
                ->join('tags', 'post_tags.tag_id', '=', 'tags.id')
                ->get();
    }

    public function compose(View $view) {
        $view->with('tags', $this->_tags);
    }

}
