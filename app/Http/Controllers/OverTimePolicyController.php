<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OverTimePolicy;
use Alert;

class OverTimePolicyController extends Controller
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
        $overtimes = OverTimePolicy::paginate(10);
        return view('company-policy.over-time.index',compact('overtimes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company-policy.over-time.create');
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
        $rules = [
            'name' => 'required|string|max:191|unique:over_time_policies',
            'willPay' => 'required',
            'rate' => 'required',
        ];

        if (empty($request->get('isDay')) && empty($request->get('isWeek'))) {
            $rules['overtimeProcess'] = 'required';
        } else if(!empty($request->get('isDay'))){
            $rules['dayHours'] = 'required';
        } else if(!empty($request->get('isWeek'))){
            $rules['weekHours'] = 'required';
        }

        $this->validate($request, $rules);


        $input['name'] = $request['name'];
        $input['willPay'] = $request['willPay'];

        if($request['isDay']){
            $input['isDay'] = 1;
            $input['dayHours'] = $request['dayHours'];
        }
        if($request['isWeek']){
            $input['isWeek'] = 1;
            $input['weekHours'] = $request['weekHours'];
        }

        $input['rate'] = $request['rate'];
        $input['comment'] = $request['comment'];

        OverTimePolicy::create($input);

        Alert::success('Over Time Policy Added Successfully. Add more, if needed.'); 

        return redirect(route('overtime-policy.index'));
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
        $overtime = OverTimePolicy::findOrFail($id);
        return view('company-policy.over-time.edit',compact('overtime'));

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
        $overtime = OverTimePolicy::findOrFail($id);
        $rules = [
            
            'name' => 'required|string|max:191|unique:over_time_policies,name,'.$overtime->id,
            'willPay' => 'required',
            'rate' => 'required',

        ];

        if (empty($request->get('isDay')) && empty($request->get('isWeek'))) {
            $rules['overtimeProcess'] = 'required';
        } 
        if(!empty($request->get('isDay'))){
            $rules['dayHours'] = 'required';
        } 
        if(!empty($request->get('isWeek'))){
            $rules['weekHours'] = 'required';
        }

        $this->validate($request, $rules);


        $overtime['name'] = $request['name'];
        $overtime['willPay'] = $request['willPay'];

        if($request['isDay']){
            $overtime['isDay'] = 1;
            $overtime['dayHours'] = $request['dayHours'];
        }else {
            $overtime['isDay'] = null;
            $overtime['dayHours'] = null;
        }

        if($request['isWeek']){
            $overtime['isWeek'] = 1;
            $overtime['weekHours'] = $request['weekHours'];
        } else {
            $overtime['isWeek'] = null;
            $overtime['weekHours'] = null;
        }

        $overtime['rate'] = $request['rate'];
        $overtime['comment'] = $request['comment'];
        $overtime->update();


        Alert::success('Over time policy has been updated successfully.'); 

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
        $delete =  OverTimePolicy::destroy($id);
    }
}
