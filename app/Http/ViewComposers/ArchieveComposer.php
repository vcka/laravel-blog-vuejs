<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;

class ArchieveComposer {

    protected $_data;

    public function __construct() {
        $posts = \App\Model\user\post::select(
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
        $this->_data = $data;
    }

    public function compose(View $view) {
        $view->with('archive_data', $this->_data);
    }

}
