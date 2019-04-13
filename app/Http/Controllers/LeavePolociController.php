<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeavePolicy;
use App\Leave;
use Alert;


class LeavePolociController extends Controller
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
        $leavePolicies = LeavePolicy::paginate(3);
        //return $leavePolicies;
        return view('company-policy.leave.index',compact('leavePolicies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company-policy.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request,[
            'name' => 'required|string|max:191|unique:leave_policies',
            'leaveName.*' => 'required|string',
            'annualDay.*' => 'required|integer|max:100'
        ]);





        //------------------------------

        $leavePolicy = LeavePolicy::create([
            'name' => $request->name
        ]);

        $rows = $request->rows;

        foreach ($rows as $key => $row) 
        {
            $payFor = 1;
            if(empty($row['payFor']))
            {
                $payFor = 0;
            }

            $isApprove = 1;
            if(empty($row['isApprove']))
            {
                $isApprove = 0;
            }


            $leaveType = Leave::create([

                'leave_policy_id' => $leavePolicy->id,
                'leaveName' => $row['leaveName'],
                'leaveNumber' => $row['leaveNumber'],
                'payFor' =>  $payFor,
                'isApprove' => $isApprove,
                'color' => $row['color']

            ]);
        }
        

        Alert::success('Leave Policy Added Successfully. Add more, if needed.'); 
        return redirect(route('leave-policy.index'));
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
        $leavePolicy = LeavePolicy::findOrFail($id);
        return view('company-policy.leave.edit',compact('leavePolicy'));
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

        $leavePolicy = LeavePolicy::findOrFail($id);

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'leaveName.*' => 'required|string',
            'annualDay.*' => 'required|integer|max:100'
        ]);

        $leavePolicy->update($request->all());


        $rows = $request->rows;
        //dd($rows);
        foreach ($rows as $key => $row) 
        {

            //update if found row->id
            if(!empty($row['id'])) {

                $leave = Leave::findOrFail($row['id']);

                if(empty($row['payFor']))
                {
                    $payFor = 0;
                } else {
                    $payFor = $row['payFor'];
                }
                
                if(empty($row['isApprove']))
                {
                    $isApprove = 0;
                } else {
                    $isApprove = $row['isApprove'];
                }

                $leave['leave_policy_id'] = $leavePolicy->id; 
                $leave['leaveName'] = $row['leaveName']; 
                $leave['leaveNumber'] = $row['leaveNumber']; 
                $leave['payFor'] = $payFor; 
                $leave['isApprove'] = $isApprove; 
                $leave['color'] = $row['color']; 


                $leave->update();

            }
            //create new if found row->id 
            else 
            {

                $payFor = 1;
                if(empty($row['payFor']))
                {
                    $payFor = 0;
                }

                $isApprove = 1;
                if(empty($row['isApprove']))
                {
                    $isApprove = 0;
                }

                $leave = Leave::create([

                    'leave_policy_id' => $leavePolicy->id,
                    'leaveName' => $row['leaveName'],
                    'leaveNumber' => $row['leaveNumber'],
                    'payFor' =>  $payFor,
                    'isApprove' => $isApprove,
                    'color' => $row['color']

                ]);
            }
        }


        Alert::success('Leave Policy Updated Successfully.'); 
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
        $delete =  LeavePolicy::destroy($id);
    }

    public function leaveDestroy($id)
    {
        //
        $leaveDelete =  Leave::destroy($id);
    }
}
