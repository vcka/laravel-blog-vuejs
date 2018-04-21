<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\admin\admin;
use App\Model\admin\role;
use Illuminate\Http\Request;
use Image;

class UserController extends Controller {

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
        //$users = admin::all();
        //return view('admin.user.show', compact('users'));
        return view('admin.user.showjq');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $roles = role::all();
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        /* $this->validate($request,[
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:admins',
          'phone' => 'required|numeric',
          'password' => 'required|string|min:6|confirmed',
          ]);
          $request['password'] = bcrypt($request->password);
          $user = admin::create($request->all());
          $user->roles()->sync($request->role); */

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'phone' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
            'profile_image' => 'required',
        ]);
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('admin/profile/' . $imageName);
            Image::make($image)->resize(160, 160)->save($location);
            //$imageName = $request->profile_image->store('public/profile');
        }

        $admin = new admin;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->profile_image = !empty($imageName) ? $imageName : $admin->profile_image;
        $admin->password = bcrypt($request->password);
        $admin->status = $request->status;

        $admin->save();
        $admin->roles()->sync($request->role);

        return redirect(route('user.index'));
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
        $user = admin::find($id);
        $roles = role::all();
        return view('admin.user.edit', compact('user', 'roles'));
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|numeric',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('admin/profile/' . $imageName);
            Image::make($image)->resize(160, 160)->save($location);
            //$imageName = $request->profile_image->store('public/profile');
        }

        $admin = admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->profile_image = !empty($imageName) ? $imageName : $admin->profile_image;
        $admin->status = $request->status;
        $admin->save();
        admin::find($id)->roles()->sync($request->role);
        return redirect(route('user.index'))->with('message', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        admin::where('id', $id)->delete();
        return redirect()->back()->with('message', 'User is deleted successfully');
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


        $count = admin::where($where)->count();
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

        $rows = admin::where($where)->offset($start)
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
            $isEdit = '<a href="' . route('user.edit', $row->id) . '"><span class="glyphicon glyphicon-edit"></span></a>';
            //}
            $response['rows'][$i]['id'] = $row->id;
            $response['rows'][$i]['cell'] = array(
                $sno,
                $row->name,
                $row->email,
                date('d-M-Y h:m:i', strtotime($row->created_at)),
                $isEdit,
                '<form id="delete-form-' . $row->id . '" method="post" action="' . route('user.destroy', $row->id) . '" style="display: none">
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
