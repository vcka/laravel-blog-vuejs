<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin\Method;
use App\Model\admin\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class MethodController extends Controller {

    protected $methods;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Method $methods) {
        $this->middleware('auth:admin');
        $this->methods = $methods;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if (FALSE) {


            $page = (int) Input::get('page', 1);
            $cname = Input::get('cname', null);
            $aname = Input::get('name', null);
            $lname = Input::get('label', null);

            $where = array();

            if ($aname) {
                $where[] = ['methods.name', 'LIKE', '%' . $aname . '%'];
            }
            if ($lname) {
                $where[] = ['methods.label', 'LIKE', '%' . $lname . '%'];
            }

            if ($cname) {
                $where[] = ['pages.name', 'LIKE', '%' . $cname . '%'];
            }

            $methods = Method::where($where)->join('pages', 'pages.id', '=', 'methods.page_id')->select('methods.*')->paginate(20);

            $methods->appends(['cname' => $cname, 'name' => $aname, 'label' => $lname]);

            return view('admin.method.index', compact('methods', 'page', 'cname', 'aname', 'lname'));
        } else {
            return view('admin.method.showjq');
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $pages = Page::all();
        return view('admin.method.create', compact('pages'));
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
            'controller' => 'required',
        ]);
        $method = new Method;
        $method->name = $request->name;
        $method->label = $request->label;
        $method->page_id = $request->controller;
        $method->save();

        return redirect(route('method.index'));
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
        $method = Method::where('id', $id)->first();
        $pages = Page::all();
        return view('admin.method.edit', compact('method', 'pages'));
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
            'controller' => 'required',
        ]);
        $method = Method::find($id);
        $method->name = $request->name;
        $method->label = $request->label;
        $method->page_id = $request->controller;
        $method->save();
        return redirect(route('method.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Method::where('id', $id)->delete();
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
        
        $count = Method::where($where)->join('pages', 'pages.id', '=', 'methods.page_id')->count();
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

        $rows = Method::where($where)
                        ->join('pages', 'pages.id', '=', 'methods.page_id')
                        ->select('methods.*','pages.name as page_name')
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($sidx, $sord)->get();
        
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
            $isEdit = '<a href="' . route('method.edit', $row->id) . '"><span class="glyphicon glyphicon-edit"></span></a>';
            //}
            $response['rows'][$i]['id'] = $row->id;
            $response['rows'][$i]['cell'] = array(
                $sno,
                $row->page_name,
                $row->label,
                $row->name,
                date('d-M-Y h:m:i', strtotime($row->created_at)),
                $isEdit,
                '<form id="delete-form-' . $row->id . '" method="post" action="' . route('method.destroy', $row->id) . '" style="display: none">
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
