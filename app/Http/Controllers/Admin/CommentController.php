<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\user\Comment;
use Illuminate\Support\Facades\Input;

class CommentController extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index() {
        //echo 'Here';
        //die();
        if (false) {
            $where = array();
            $comments = Comment::where($where)->join('posts', 'posts.id', '=', 'laravellikecomment_comments.item_id')->join('users', 'users.id', '=', 'laravellikecomment_comments.user_id')->select('laravellikecomment_comments.*', 'posts.title', 'users.name', 'users.email')->orderBy('id', 'desc')->paginate(20);
            //$comments = comment::all();
            //dd($comments);
            return view('admin.comment.index', compact('comments'));
        } else {
            return view('admin.comment.showjq');
        }
    }

    public function approveComment(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'status' => 'required'
        ]);
        $response = array();
        $comment = comment::find($request->id);
        $comment->approved = $request->status;
        $isDataUpdated = $comment->save();
        if ($isDataUpdated) {
            $response = array(
                'response_code' => 200,
                'response_status' => 'success',
                'message' => 'Comment succefully updated.',
            );
        } else {
            $response = array(
                'response_code' => 201,
                'response_status' => 'error',
                'message' => 'Comment not approved.',
            );
        }

        echo json_encode($response);
    }

    public function getData(Request $request) {

        $paramArr = $request->all();

        $page = $paramArr['page']; // get the requested page
        $limit = $paramArr['rows']; // get how many rows we want to have into the grid
        $sidx = $paramArr['sidx']; // get index row - i.e. user click to sort
        $sord = $paramArr['sord']; // get the direction
        if (!$sidx)
            $sidx = 'id';

        $where = array();

        if (!empty($paramArr['title'])) {
            $where[] = array('comment', 'LIKE', '%' . $paramArr['title'] . '%');
        }


        //$count = comment::where($where)->count();
        $count = Comment::where($where)
                ->join('posts', 'posts.id', '=', 'laravellikecomment_comments.item_id')
                ->join('users', 'users.id', '=', 'laravellikecomment_comments.user_id')
                ->count();
        //dd($count);

        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page = $total_pages;
        if ($limit < 0)
            $limit = 0;
        $start = $limit * $page - $limit; // do not put $limit*($page - 1)
        if ($start < 0)
            $start = 0;

        //echo $start . '--' . $limit . '--' . $sidx . '--' . $sord;die;

        $rows = Comment::where($where)
                        ->join('posts', 'posts.id', '=', 'laravellikecomment_comments.item_id')
                        ->join('users', 'users.id', '=', 'laravellikecomment_comments.user_id')
                        ->select('laravellikecomment_comments.*', 'posts.title', 'users.name', 'users.email')
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($sidx, $sord)->get();
        //dd($rows);
        
        $response = array();
        $response['page'] = $page;
        $response['total'] = $total_pages;
        $response['records'] = $count;
        $i = 0;
        $sno = (($page - 1) * $limit) + 1;
        
        foreach ($rows as $row) {
            //dd($row);
            //$isEdit = '<a href="javascript:void(0);"><span class="glyphicon glyphicon-edit"></span></a>';
            //dd(Auth::user()->can('home.index'));
            //if (Auth::user()->can('post.edit')) {
            $isApproved = '<a href="' . route('comment.edit', $row->id) . '"><span class="glyphicon glyphicon-edit"></span></a>';
            //}
            $checked = '';
            if ($row->approved == 1) {
                $checked = 'checked="checked"';
            }

            $isApproved = '<input type="checkbox" class="checkbox_approved" data-id = "' . $row->id . '" data-status = "' . $row->approved . '" ' . $checked . '>';

            $response['rows'][$i]['id'] = $row->id;
            $response['rows'][$i]['cell'] = array(
                $sno,
                $row->name,
                $row->email,
                $row->comment,                
                date('d-M-Y h:m:i', strtotime($row->created_at)),
                $isApproved
            );
            $i++;
            $sno++;
        }
        echo json_encode($response);
    }

}
