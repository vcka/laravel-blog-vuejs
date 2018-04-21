<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Model\user\category_post;
use App\Model\user\post_tag;
use App\Model\user\post;

class SidebarController extends Controller {

    public function getSideBar() {
        return [
            'categories' => category_post::select('categories.name', 'categories.slug', \DB::raw('COUNT(category_posts.category_id) as post_count'))->groupBy('category_posts.category_id')
                    ->join('categories', 'category_posts.category_id', '=', 'categories.id')->get(),
            'tags' => post_tag::select('tags.name', 'tags.slug', \DB::raw('COUNT(post_tags.tag_id) as post_count'))->groupBy('post_tags.tag_id')
                    ->join('tags', 'post_tags.tag_id', '=', 'tags.id')->get(),
            'archive_data' => [$this->getArchieveData()]
        ];
    }

    public function getArchieveData() {
        $posts = post::select(
                        \DB::raw('YEAR(created_at) as year'), \DB::raw('MONTH(created_at) as month'), \DB::raw('MONTHNAME(created_at) as month_name'), \DB::raw('COUNT(*) as post_count')
                )
                ->groupBy('year')
                ->groupBy(\DB::raw('MONTH(created_at)'))
                ->orderBy('year', 'DESC')
                ->orderBy('month', 'DESC')
                ->get();

        $data = array();
        foreach ($posts as $post) {
            $year = $post['year'];
            $month_name = $post['month_name'];
            $month = $post['month'];
            $postCount = $post['post_count'];
            if (array_key_exists($year, $data)) {
                $data[$year]['total_post'] += $postCount;
            } else {
                $data[$year]['total_post'] = $postCount;
            }
            $data[$year]['months'][$month_name] = array(
                'count' => $postCount,
                'month' => $month,
            );
        }
        return $data;
    }

}
