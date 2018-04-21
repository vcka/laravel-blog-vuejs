<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Model\user\post;
use App\Http\Controllers\Controller;
use App\Traits\PostTransformData;

class ArchivePostController extends Controller {

    use PostTransformData;

    public function getPostByYearJson(Request $request) {
        $year = $request->year;
        return PostTransformData::TransformData(post::with(['likes', 'posted_by'])->where('status', 1)->where(\DB::raw('YEAR(created_at)'), $year)->orderBy('created_at', 'DESC')->paginate(5));
    }

    public function getPostByMonthJson(Request $request) {
        $year = $request->year;
        $month = $request->month;
        return PostTransformData::TransformData(post::with(['likes', 'posted_by'])->where('status', 1)->where(\DB::raw('YEAR(created_at)'), $year)->where(\DB::raw('MONTH(created_at)'), $month)->orderBy('created_at', 'DESC')->paginate(5));
    }

}
