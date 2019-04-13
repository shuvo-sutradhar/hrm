<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkingHourPolicy;
use Alert;

class WorkingHourPolicyController extends Controller
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
        $workingHours = WorkingHourPolicy::paginate(10);
        return view('company-policy.workingHour.index',compact('workingHours'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company-policy.workingHour.create');
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
            'name' => 'required|string|max:191|unique:working_hour_policies',
            'workingHour' => 'required|integer',
            'workingHoliday' => 'required|integer',
        ]);
        //
        WorkingHourPolicy::create([
            'name' => $request['name'],
            'workingHour' => $request['workingHour'],
            'workingHoliday' => $request['workingHoliday'],
            'comment' => $request['comment']
        ]);

        Alert::success('Working Hour Policy Added Successfully.'); 
        return redirect(route('working-hour-policy.index'));
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
        $workingHour = WorkingHourPolicy::findOrFail($id);
        return view('company-policy.workingHour.edit',compact('workingHour'));
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
        $workingHour = WorkingHourPolicy::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191|unique:working_hour_policies,name,'.$workingHour->id,
            'workingHour' => 'required|integer',
            'workingHoliday' => 'required|integer',
        ]);
        

        $workingHour['name'] = $request['name'];
        $workingHour['workingHour'] = $request['workingHour'];
        $workingHour['workingHoliday'] = $request['workingHoliday'];
        $workingHour['comment'] = $request['comment'];
        $workingHour->update();

        Alert::success('Working Hour Policy Updated Successfully.'); 
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
        return WorkingHourPolicy::destroy($id);
    }
}
