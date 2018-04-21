<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\user\category;
use App\Model\user\post;
use App\Model\user\tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class PostController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //$posts = post::all();
        //return view('admin.post.show', compact('posts'));        
        return view('admin.post.showjq');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $tags = tag::all();
        $categories = category::all();
        return view('admin.post.post', compact('tags', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'image' => 'required',
        ]);
        if ($request->hasFile('image')) {
            //$imageName = $request->image->store('public');
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('post_image/' . $imageName);
            Image::make($image)->resize(900, 300)->save($location);
        } else {
            return 'No';
        }
        $post = new post;
        $post->image = $imageName;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = $request->status;
        $post->posted_by = Auth::user()->id;
        $post->save();
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);

        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $post = post::with('tags', 'categories')->where('id', $id)->first();
        $tags = tag::all();
        $categories = category::all();
        return view('admin.post.edit', compact('tags', 'categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $this->validate($request, [
            'title' => 'required',
            'subtitle' => 'required',
            'slug' => 'required',
            'body' => 'required'
        ]);

        $post = post::find($id);

        if (empty($post->image)) {
            $this->validate($request, [
                'image' => 'required'
            ]);
        } else {
            $imageName = $post->image;
        }

        if ($request->hasFile('image')) {
            //$imageName = $request->image->store('public');
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('post_image/' . $imageName);
            Image::make($image)->resize(900, 300)->save($location);
        }

        $post->image = $imageName;
        $post->title = $request->title;
        $post->subtitle = $request->subtitle;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->status = $request->status;
        $post->posted_by = Auth::user()->id;
        $post->tags()->sync($request->tags);
        $post->categories()->sync($request->categories);
        $post->save();

        return redirect(route('post.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        post::where('id', $id)->delete();
        return redirect()->back();
    }

    public function getPostData(Request $request) {
        $paramArr = $request->all();        
        $page = $paramArr['page']; // get the requested page
        $limit = $paramArr['rows']; // get how many rows we want to have into the grid
        $sidx = $paramArr['sidx']; // get index row - i.e. user click to sort
        $sord = $paramArr['sord']; // get the direction
        if (!$sidx)
            $sidx = 'id';

        $where = array();

        if (!empty($paramArr['title'])) {
            $where[] = array('title', 'LIKE', '%' . $paramArr['title'] . '%');
        }

        if (!empty($paramArr['subtitle'])) {
            $where[] = array('subtitle', 'LIKE', '%' . $paramArr['subtitle'] . '%');
        }
        
        $count = post::where($where)->count();
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

        $posts = post::where($where)->offset($start)
                        ->limit($limit)
                        ->orderBy($sidx, $sord)->get();
        //dd($posts);

        $response = array();
        $response['page'] = $page;
        $response['total'] = $total_pages;
        $response['records'] = $count;
        $i = 0;
        $sno = (($page - 1) * $limit) + 1;
        $canEdit = Auth::user()->hasPermissionTo('post.edit');
        
        foreach ($posts as $post) {
            $isEdit = '<a href="javascript:void(0);"><span class="glyphicon glyphicon-edit"></span></a>';                        
            if ($canEdit) {
                $isEdit = '<a href="' . route('post.edit', $post->id) . '"><span class="glyphicon glyphicon-edit"></span></a>';
            }
            $response['rows'][$i]['id'] = $post->id;
            $response['rows'][$i]['cell'] = array(
                $sno,
                $post->title,
                $post->subtitle,
                date('d-M-Y h:m:i',strtotime($post->created_at)),
                ($post->status) ? '<span class="label label-success">Published</span>' : '<span class="label label-danger">Unpublished</span>',
                $isEdit,
                '<form id="delete-form-' . $post->id . '" method="post" action="' . route('post.destroy', $post->id) . '" style="display: none">
                                ' . csrf_field() . method_field('DELETE') . '</form>'
                . '<a href="javascript:void(0);" class="delete" data-remove="delete-form-' . $post->id . '" >'
                . '<span class="glyphicon glyphicon-trash"></span></a>'
            );
            $i++;
            $sno++;
        }

        //$posts = post::all();
        echo json_encode($response);

        //return view('admin.post.show', compact('posts'));
        //return view('admin.post.showjq', compact('posts'));
    }

}
