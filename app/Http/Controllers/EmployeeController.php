<?php

namespace App\Http\Controllers;

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
        return view('employee.index');
    }
    /**
     * Display datatable data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmployee()
    {
        //

        return Datatables::of(User::query())
            ->setRowClass('{{ $id % 2 == 0 ? "alert-success" : "alert-warning" }}')
            ->setRowId('{{$id}}')
            ->setRowAttr([ 'align' => 'center'])
            ->editColumn('active', function(User $user) {
                return  $user->active == 1 ? 'Active' : 'Inactive';
            })
            ->editColumn('created_at', function(User $user) {
                return  $user->created_at->diffForHumans();
            })
            //->removeColumn('updated_at')
            ->addColumn('action', 'column')
            ->rawColumns(['action'])
            ->make(true);
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
    }
}
