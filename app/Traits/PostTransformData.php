<?php

namespace App\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait PostTransformData {

    public static function TransformData(LengthAwarePaginator $paginator) {
        $paginator->getCollection()->transform(function ($post) {
            $postArray = $post->toArray();
            $postArray['like_count'] = $post->likes->count();
            return $postArray;
        });
        return $paginator;
    }

}
