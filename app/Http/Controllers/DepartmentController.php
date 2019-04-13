<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Designation;
use Alert;

class DepartmentController extends Controller
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
        $departments = Department::paginate(10);
        return view('department.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('department.create');
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
        $this->validate($request, [

            'name' => 'required|string|unique:departments'

        ]);


        $department = Department::create($request->all());
        $designations = $request->designation;
        foreach ($designations as $designation)
        {
            $input['name'] = $designation; 
            $input['department_id'] = $department->id; 
            Designation::create($input);
        }



        Alert::success('Department Added Successfully. Add more, if needed.'); 

        return redirect(route('department.index'));
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
        $department = Department::where('slug',$slug)->firstOrFail();
        return view('department.edit',compact('department'));
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
        $this->validate($request, [

            'name' => 'required|string'

        ]);

        $department = Department::where('slug',$slug)->first();
        $department['name'] = $request->name;
        $department->update();


        $designations = $request->designation;
        foreach ($designations as $designation)
        {
            $input['name'] = $designation; 
            $input['department_id'] = $department->id; 
            Designation::updateOrCreate($input);
        }

        Alert::success('Department Upda Successfully.'); 
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
        $delete =  Department::destroy($id);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function designationDestroy($id)
    {
        //
        $delete =  Designation::destroy($id);
    }
}
