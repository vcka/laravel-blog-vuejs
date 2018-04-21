<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\user\like;
use App\Model\user\post;
use App\Model\user\category;
use App\Model\user\tag;
use App\Traits\PostTransformData;
use JWTAuth;

class PostController extends Controller {

    use PostTransformData;

    public function post(post $post) {
        if (FALSE) {
            $currentUser = Auth::user();
            $userData = json_encode(array(
                'name' => ($currentUser) ? $currentUser->name : '',
                'email' => ($currentUser) ? $currentUser->email : '',
            ));

            //$postId = $post->id;

            /* $comments = comment::select('comments.*', \Illuminate\Support\Facades\DB::raw("COUNT(commentlikes.id) as number_of_likes"))
              ->leftjoin('commentlikes', 'commentlikes.comment_id', '=', 'comments.id')
              ->where('comments.approved', 1)
              ->where('comments.post_id', $postId)
              ->groupBy('comments.id')
              ->orderBy('comments.id', 'desc')
              ->get(); */

            return view('user.post', compact('userData', 'post'));
        } else {
            return view('user.post-details');
        }
    }

    public function getAllPosts() {
        return $posts = PostTransformData::TransformData(post::with(['likes', 'posted_by'])->where('status', 1)->orderBy('created_at', 'DESC')->paginate(5));
    }

    public function saveLike(request $request) {
        $response = array();
        $user = JWTAuth::toUser($request->token);
        $userId = $user->id;
        $postId = (int) $request->postId;
        if (!empty($postId)) {
            $likecheck = like::where(['user_id' => $userId, 'post_id' => $postId])->first();            
            $response = array(
                'status' => 'success',
                'response_code' => 200,
                'message_code' => 0
            );
            if ($likecheck) {
                like::where(['user_id' => $userId, 'post_id' => $postId])->delete();                
                $response['message_code'] = 1;                
            } else {
                $like = new like;
                $like->user_id = $userId;
                $like->post_id = $postId;
                $like->save();
                $response['message_code'] = 2;                
            }
            $totalLike = like::where(['post_id' => $postId])->count();                
            $response['likes'] = $totalLike;
        } else {
            $response = array(
                'status' => 'error',
                'response_code' => 201,
                'message' => 'Not a valid request'
            );
        }
        return response()->json($response);
    }

    public function postDetails(post $post, Request $request) {
        $slug = $request->slug;
        $data = $post->post($slug)->get();
        return $data;
    }

    public function postCategoryDetails(category $category) {
        return PostTransformData::TransformData($category->posts());
    }

    public function postTagDetails(tag $tag) {
        return PostTransformData::TransformData($tag->posts());
    }

    public function postComments(Request $request) {
        $comment_item_id = $request->id;
        echo view('laravelLikeComment::comment')->with('comment_item_id', $comment_item_id);
    }

}
