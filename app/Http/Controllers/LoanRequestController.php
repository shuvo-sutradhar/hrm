<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\LoanRequest;
use Alert;
use Auth;

class LoanRequestController extends Controller
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
        $loanRequests = LoanRequest::orderBy('created_at', 'desc')->paginate(10);
        return view('loan-request.index',compact('loanRequests'));
    }
    /**
     * Display the panding leave request
     *
     * @return \Illuminate\Http\Response
     */
    public function pending()
    {
        //
        $loanRequests = LoanRequest::where('status',1)->orderBy('created_at', 'desc')->paginate(10);
        return view('loan-request.pending',compact('loanRequests'));
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
        return view('loan-request.create', compact('employees'));
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
            'employee_id'            => 'required|integer',
            'request_amount'        => 'required|integer',
            'installment_per_month' => 'required|integer',
            'start_installment_date'=> 'required',
            'last_installment_date' => 'required',
            'status'                => 'required',

        ]);

        $performance = LoanRequest::create([

            'apply_date'            =>  $request['apply_date'] ? date('Y-m-d H:i:s', strtotime($request['apply_date'])) : NULL,
            'employee_id'           =>  $request->employee_id,
            'request_amount'        =>  $request->request_amount,
            'installment_per_month' =>  $request->installment_per_month,
            'start_installment_date'=>  $request['start_installment_date'] ? date('Y-m-d H:i:s', strtotime($request['start_installment_date'])) : NULL,
            'last_installment_date' =>  $request['last_installment_date'] ? date('Y-m-d H:i:s', strtotime($request['last_installment_date'])) : NULL,
            'status'                =>  $request->status,
            'comment'               =>  $request->comment,
            'status_change_by'      =>  $request->status != 1 ? Auth::user()->id : NULL,

        ]);

        Alert::success('Loan Requested Successfully.'); 
        return redirect()->route('loan-request.index'); 
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
        $loanRequest = LoanRequest::findOrFail($id);
        return view('loan-request.show', compact('loanRequest'));
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
        $loanRequest = LoanRequest::findOrFail($id);
        return view('loan-request.edit', compact('loanRequest','employees'));
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

        $leaveStaus = LoanRequest::where('id',$id)->update(['status' => $statusData,'status_change_by'=>Auth::user()->id]);

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
        return LoanRequest::destroy($id);
    }
}
