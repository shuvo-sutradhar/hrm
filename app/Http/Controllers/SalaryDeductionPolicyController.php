<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SalaryDeduction;
use Alert;

class SalaryDeductionPolicyController extends Controller
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
        $salaryDeductions = SalaryDeduction::paginate(10);
        return view('company-policy.salary-deduction.index',compact('salaryDeductions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company-policy.salary-deduction.create');
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
            'policyName' => 'required|string|max:191|unique:salary_deductions',
            'deductionForm' => 'required',
            'deductionAfter' => 'required',
            'deductionRate' => 'required',
        ]);
        //
        SalaryDeduction::create([
            'policyName' => $request['policyName'],
            'deductionForm' => $request['deductionForm'],
            'deductionAfter' => $request['deductionAfter'],
            'deductionRate' => $request['deductionRate'],
            'deductionComment' => $request['deductionComment'],
        ]);
        

        Alert::success('Salary Deduction Policy Added Successfully.'); 
        return redirect(route('salary-deduction-policy.index'));
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
        $salaryDeduction = SalaryDeduction::findOrFail($id);
        return view('company-policy.salary-deduction.edit',compact('salaryDeduction'));
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
        $salaryDeduction = SalaryDeduction::findOrFail($id);
        //
        $this->validate($request, [
            'policyName' => 'required|string|max:191|unique:salary_deductions,policyName,'.$salaryDeduction->id,
            'deductionForm' => 'required',
            'deductionAfter' => 'required',
            'deductionRate' => 'required',
        ]);
        //
        $salaryDeduction['policyName'] = $request['policyName'];
        $salaryDeduction['deductionForm'] = $request['deductionForm'];
        $salaryDeduction['deductionAfter'] = $request['deductionAfter'];
        $salaryDeduction['deductionRate'] = $request['deductionRate'];
        $salaryDeduction['deductionComment'] = $request['deductionComment'];
        $salaryDeduction->update();
        

        Alert::success('Salary Deduction Policy Updated Successfully.'); 
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
        return SalaryDeduction::destroy($id);
    }
}
