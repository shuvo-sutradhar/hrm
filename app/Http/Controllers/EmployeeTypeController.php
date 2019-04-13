<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeType;
use Alert;
class EmployeeTypeController extends Controller
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
        $employmentTypes = EmployeeType::paginate(2);
        return view('employee-type.index',compact('employmentTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employee-type.create');
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
            'type_name' => 'required|string|max:255|unique:employee_types',
        ]);

        $input['type_name'] = $request->type_name; 
        $input['type_desc'] = $request->type_desc; 

        EmployeeType::create($input);

        Alert::success('Employment Type added successfully.'); 
        return redirect(route('employee-type.index'));
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
        $employeeType = EmployeeType::findOrFail($id);
        return view('employee-type.edit',compact('employeeType'));
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
        $this->validate($request, [

            'type_name' => 'required|string'

        ]);

        $department = EmployeeType::findOrFail($id);
        $department['type_name'] = $request->type_name;
        $department['type_desc'] = $request->type_desc;
        $department->update();

        Alert::success('Employment Type updated successfully.'); 
        return redirect(route('employee-type.index'));
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
        EmployeeType::destroy($id);

        return redirect()->back();
    }
}
