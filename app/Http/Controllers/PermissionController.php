<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;
use Alert;

class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:add-permission'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:view-permission'], ['only' => 'index']);
        $this->middleware(['permission:edit-permission'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:delete-permission'], ['only' => 'delete']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $permissions = Permission::all();
        return view('role-permission.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('role-permission.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name' => 'required|unique:permissions',
            'module' => 'required',
        ]);

        $requestData['name'] = $request->name;
        $requestData['module'] = $request->module;
        $permission = Permission::create($requestData);
        if($permission) {
            Alert::success('Permission Added Successfully. Add more, if needed.'); 
        } else {
            Alert::error('Something went wrong', 'Oops!');
        }
        return redirect()->back();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $permission = Permission::findOrFail($id);
        return view("role-permission.permission.edit", compact('permission'));
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->module = $request->module;
        $permission->update();
        Alert::success('Permission updated Successfully.'); 
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete =  Permission::destroy($id);
    }
}
