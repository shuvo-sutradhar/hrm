<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AdvanceRequest;
use Alert;
use Auth;

class AdvanceRequestController extends Controller
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
        $advanceRequests = AdvanceRequest::orderBy('created_at', 'desc')->paginate(10);
        return view('advance-request.index',compact('advanceRequests'));
    }
    /**
     * Display the panding leave request
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        //
        $advanceRequests = AdvanceRequest::where('status',1)->orderBy('created_at', 'desc')->paginate(10);
        return view('advance-request.panding',compact('advanceRequests'));
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
        return view('advance-request.create', compact('employees'));
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
        $this->validate(request(),[

            'apply_date'            => 'required',
            'employee_id'           => 'required|integer',
            'request_amount'        => 'required|integer',
            'month'                 => 'required|integer',
            'year'                  => 'required',
            'status'                => 'required',

        ]);

        $advanceRequest = AdvanceRequest::create([

            'apply_date'            =>  $request['apply_date'] ? date('Y-m-d H:i:s', strtotime($request['apply_date'])) : NULL,
            'employee_id'           =>  $request->employee_id,
            'request_amount'        =>  $request->request_amount,
            'month'                 =>  $request->month,
            'year'                  =>  $request->year,
            'status'                =>  $request->status,
            'comment'               =>  $request->comment,
            'status_change_by'      =>  $request->status != 1 ? Auth::user()->id : NULL,

        ]);

        Alert::success('Advance Salary Requested Successfully.'); 
        return redirect()->route('advance-request.index'); 
    }


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

        $leaveStaus = AdvanceRequest::where('id',$id)->update(['status' => $statusData,'status_change_by'=>Auth::user()->id]);

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
        $advanceRequest = AdvanceRequest::findOrFail($id);
        return view('advance-request.show', compact('advanceRequest'));
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
        $advanceRequest = AdvanceRequest::findOrFail($id);
        return view('loan-request.edit', compact('advanceRequest','employees'));
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
        return AdvanceRequest::destroy($id);
    }
}
