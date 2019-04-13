<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveRequest;
use Carbon\Carbon;
use App\User;
use App\Leave;
use Alert;
use Auth;

class LeaveRequestController extends Controller
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
        $leaveRequests = LeaveRequest::orderBy('created_at', 'desc')->paginate(8);
        return view('leave-request.index',compact('leaveRequests'));
    }
    /**
     * Display the panding leave request
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        //
        $leaveRequests = LeaveRequest::where('status',1)->orderBy('created_at', 'desc')->paginate(8);
        return view('leave-request.pending',compact('leaveRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $employees = User::pluck('name','id')->all();
        $leaves = Leave::pluck('leaveName','id')->all();
        return view('leave-request.create', compact('employees','leaves'));
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
            'apply_date' => 'required',
            'employee_id' => 'required|integer',
            'leave_id' => 'required|integer',
            'duration' => 'required',
            'status' => 'required',
        ];

        if (!empty($request->get('duration')) && ($request->get('duration') == 1)) {
            $rules['start_date'] = 'required';
        } else if(!empty($request->get('duration')) && ($request->get('duration') == 2)){
            $rules['from'] = 'required';
            $rules['to'] = 'required';
        } else if(!empty($request->get('duration')) && ($request->get('duration') == 3)){
            $rules['start_date'] = 'required';
            $rules['hours'] = 'required';
        }
        $this->validate($request, $rules);

        $input['apply_date']    = $request['apply_date'];
        $input['employee_id']   = $request['employee_id'];
        $input['leave_id']      = $request['leave_id'];
        $input['duration']      = $request['duration'];
        $input['start_date']    = $request['duration'] == 2 ? date('Y-m-d H:i:s', strtotime($request['from'])) : date('Y-m-d H:i:s', strtotime($request['start_date']));
        $input['end_date']      = $request['to'] ? date('Y-m-d H:i:s', strtotime($request['to'])) : NULL;
        $input['hours']         = $request['hours'];
        

        //file 
        if($file = $request->file('attachment')){
            $name = time() .'leave'.'.'.$file->getClientOriginalExtension();
            $file->move('admin-assets/media/leave',$name);
            $input['attachment'] = $name;
        }

        $input['reason']        = $request['reason'];
        $input['status']        = $request['status'];


        LeaveRequest::create($input);
        Alert::success('Leave Requested Successfully.'); 
        return redirect(route('leave-request.index'));

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
        $leaveRequest = LeaveRequest::findOrFail($id);
        return view('leave-request.show', compact('leaveRequest'));

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
        $employees = User::pluck('name','id')->all();
        $leaves = Leave::pluck('leaveName','id')->all();
        $leaveRequest = LeaveRequest::findOrFail($id);
        return view('leave-request.edit', compact('employees','leaves','leaveRequest'));
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

         //
        $input = LeaveRequest::findOrFail($id);

        //
        $rules = [
            'apply_date' => 'required',
            'employee_id' => 'required|integer',
            'leave_id' => 'required|integer',
            'duration' => 'required',
            'status' => 'required',
        ];

        if (!empty($request->get('duration')) && ($request->get('duration') == 1)) {
            $rules['start_date'] = 'required';
        } else if(!empty($request->get('duration')) && ($request->get('duration') == 2)){
            $rules['from'] = 'required';
            $rules['to'] = 'required';
        } else if(!empty($request->get('duration')) && ($request->get('duration') == 3)){
            $rules['start_date'] = 'required';
            $rules['hours'] = 'required';
        }
        $this->validate($request, $rules);


        $input['apply_date']    = $request['apply_date'];
        $input['employee_id']   = $request['employee_id'];
        $input['leave_id']      = $request['leave_id'];
        $input['duration']      = $request['duration'];
        $input['start_date']    = $request['duration'] == 2 ? date('Y-m-d H:i:s', strtotime($request['from'])) : date('Y-m-d H:i:s', strtotime($request['start_date']));
        $input['end_date']      = $request['to'] ? date('Y-m-d H:i:s', strtotime($request['to'])) : NULL;
        $input['hours']         = $request['hours'];

        //file 
        if($file = $request->file('attachment')){
            if($input->attachment) {
                unlink('admin-assets/media/leave/'. $input->attachment);  
            }

            $name = time() .'leave'.'.'.$file->getClientOriginalExtension();
            $file->move('admin-assets/media/leave',$name);
            $input['attachment'] = $name;
        }



        $input['reason']        = $request['reason'];
        $input['status']        = $request['status'];
    
        $input->update();
        Alert::success('Leave Request Has Been Updated Successfully.'); 
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request ,$id,$status)
    {

        if($status == 'pending') {
            $statusData = 1;
        }
        if($status == 'approve') {
            $statusData = 2;
        }
        if($status == 'reject') {
            $statusData = 3;
        }

        $leaveStaus = LeaveRequest::where('id',$id)->update(['status' => $statusData,'status_change_by'=>Auth::user()->id]);

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


        $leaveRequest = LeaveRequest::findOrFail($id);

        if($leaveRequest->attachment) {
            unlink('admin-assets/media/leave/'. $leaveRequest->attachment);        
        }

        $leaveRequest->delete();
    }
}
