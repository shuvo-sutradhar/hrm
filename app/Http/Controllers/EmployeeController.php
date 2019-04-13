<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\User;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = User::paginate(10);
        return view('employee.index',compact('employees'));
    }

    /**
     * Display a listing of the resource in trash.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //
        $users = User::onlyTrashed()->get();
        return view('employee.trash',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employee.create');
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required'
        ]);
        $roles = $request['roles'];
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $user->assignRole($roles);

        return redirect(route('employee.index'));
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
    public function edit($slug)
    {
        //
        $user = User::where('slug',$slug)->firstOrFail();
        return view('employee.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        //
        $user = User::where('slug',$slug)->firstOrFail();

        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'sometime|string|email|max:191|unique:users,email,'.$user->id,
        ]);

        $user->name = $request['name'];
        $user->email = $user->email;

        if($request['password']) {
            $user->password = Hash::make($request['password']);
        }

        
        $user->save();

        $user->syncRoles($request->roles);
        return redirect(route('employee.index'));
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
        $user = User::where('slug',$slug)->firstOrFail();
        $user->delete();
        return redirect()->back();
    }
}
