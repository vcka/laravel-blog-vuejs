<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class PageController extends Controller {

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
        if (false) {
            $page = (int) Input::get('page', 1);
            $cname = Input::get('cname', null);
            $where = array();
            if ($cname) {
                $where[] = ['name', 'LIKE', '%' . $cname . '%'];
            }
            $pages = Page::where($where)->paginate(20);
            return view('admin.page.index', compact('pages', 'page', 'cname'));
        } else {
            return view('admin.page.showjq');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'label' => 'required',
        ]);
        $page = new Page;
        $page->name = $request->name;
        $page->label = $request->label;
        $page->save();

        return redirect(route('page.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $page = Page::where('id', $id)->first();
        return view('admin.page.edit', compact('page'));
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
            'name' => 'required',
            'label' => 'required',
        ]);
        $page = Page::find($id);
        $page->name = $request->name;
        $page->label = $request->label;
        $page->save();

        return redirect(route('page.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Page::where('id', $id)->delete();
        return redirect()->back();
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
            $where[] = array('name', 'LIKE', '%' . $paramArr['title'] . '%');
        }


        $count = page::where($where)->count();
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

        $rows = page::where($where)->offset($start)
                        ->limit($limit)
                        ->orderBy($sidx, $sord)->get();
        //dd($posts);

        $response = array();
        $response['page'] = $page;
        $response['total'] = $total_pages;
        $response['records'] = $count;
        $i = 0;

        $sno = (($page - 1) * $limit) + 1;
        //dd($sno);
        foreach ($rows as $row) {
            //$isEdit = '<a href="javascript:void(0);"><span class="glyphicon glyphicon-edit"></span></a>';
            //dd(Auth::user()->can('home.index'));
            //if (Auth::user()->can('post.edit')) {
            $isEdit = '<a href="' . route('page.edit', $row->id) . '"><span class="glyphicon glyphicon-edit"></span></a>';
            //}
            $response['rows'][$i]['id'] = $row->id;
            $response['rows'][$i]['cell'] = array(
                $sno,
                $row->label,
                $row->name,
                date('d-M-Y h:m:i', strtotime($row->created_at)),
                $isEdit,
                '<form id="delete-form-' . $row->id . '" method="post" action="' . route('page.destroy', $row->id) . '" style="display: none">
                                ' . csrf_field() . method_field('DELETE') . '</form>'
                . '<a href="javascript:void(0);" class="delete" data-remove="delete-form-' . $row->id . '" >'
                . '<span class="glyphicon glyphicon-trash"></span></a>'
            );
            $i++;
            $sno++;
        }
        echo json_encode($response);
    }

}
