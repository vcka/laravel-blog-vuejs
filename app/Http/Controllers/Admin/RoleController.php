<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\admin\Permission;
use App\Model\admin\role;
use App\Model\admin\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Model\admin\admin as AdminUser;

class RoleController extends Controller {

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
            $roles = Role::where($where)->paginate(20);
            return view('admin.role.show', compact('roles', 'page', 'cname'));
        } else {
            return view('admin.role.showjq');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $permissions = Permission::all();
        $pages = Page::all();
        return view('admin.role.create', compact('permissions', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required|max:50|unique:roles'
        ]);
        $role = new role;
        $role->name = $request->name;
        $role->save();
        $role->methods()->sync($request->methods);
        return redirect(route('role.index'));
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
        $role = role::find($id);
        $permissions = Permission::all();
        $pages = Page::all();
        $rolePage = $roleMethods = array();
        foreach ($role->methods as $roleMethod) {
            $rolePage[] = $roleMethod->page->id;
            $roleMethods[] = $roleMethod->id;
        }
        $checked['roleMethods'] = $roleMethods;
        $checked['rolePage'] = $rolePage;
        return view('admin.role.edit', compact('role', 'permissions', 'pages', 'checked'));
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
            'name' => 'required|max:50'
        ]);
        $role = role::find($id);
        $role->name = $request->name;
        $role->save();
        //$role->permissions()->sync($request->permission);
        $role->methods()->sync($request->methods);
        //$permission = AdminUser::user()->getAssignedControllerAction();
        //$request->session()->put('permission', $permission);        
        return redirect(route('role.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        role::where('id', $id)->delete();
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


        $count = role::where($where)->count();
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

        $rows = role::where($where)->offset($start)
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
            $isEdit = '<a href="' . route('role.edit', $row->id) . '"><span class="glyphicon glyphicon-edit"></span></a>';
            //}
            $response['rows'][$i]['id'] = $row->id;
            $response['rows'][$i]['cell'] = array(
                $sno,
                $row->name,
                date('d-M-Y h:m:i', strtotime($row->created_at)),
                $isEdit,
                '<form id="delete-form-' . $row->id . '" method="post" action="' . route('role.destroy', $row->id) . '" style="display: none">
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
