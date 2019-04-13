<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Performance;
use App\User;
use Alert;

class PerformanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $performances = Performance::paginate(10);
        return view('performances.index', compact('performances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name','id')->all();
        return view('performances.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate(request(),[

            'employeeID' => 'required|unique:performances,user_id',
            'initialPoints' => 'required|integer',

        ]);

        $performance = Performance::create([

            'user_id' => $request->employeeID,
            'initialPoints' =>  $request->initialPoints,
            'currentPoints' =>  $request->initialPoints,
            'lastPoints' =>  $request->initialPoints,
            'editType' =>  'increment',
            'performanceComment' =>  $request->performanceComment,
            'status' =>  '0'

        ]);


        //$performance->save();

        Alert::success('Performance Added Successfully.'); 
        return redirect()->route('performance.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('performance');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $performance = Performance::findOrFail($id);
        $users = User::pluck('name','id')->all();
        return view('performances.edit',compact('performance','users'));
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
        

        if(Input::get('reset'))  
        {
            $performance = performance::find($id);
            if($performance)
            {
                $performance->initialPoints = 0;
                $performance->lastPoints = 0;
                $performance->currentPoints = 0;
                $performance->editType = 'none';
                $performance->performanceComment = '';
                $performance->save();
            }
            Alert::success('Performance Reset Successfully.'); 
            return redirect()->route('performance.index');
        }


        else
        {
            $performance = Performance::findOrFail($id);


            $this->validate(request(),[

                'initialPoints' => 'required|integer',
                'pointAction' => 'required',

            ]);

            if($performance) 
            {
                $performance->initialPoints = $request->initialPoints;
                $performance->performanceComment = $request->performanceComment;
                $performance->lastPoints = $request->lastPoints;

                if($request->pointAction == 'increment')
                {
                    $performance->currentPoints = $performance->currentPoints + $request->lastPoints;
                    $performance->editType = 'increment';
                }
                elseif($request->pointAction == 'decrement')
                {
                    $performance->currentPoints = $performance->currentPoints - $request->lastPoints;
                    $performance->editType = 'decrement';
                }
                else
                {
                    $performance->editType = $performance->editType;
                    $performance->currentPoints = $performance->currentPoints;
                }
                $performance->save();

                Alert::success('Performance Update Successfully.'); 
                return redirect()->route('performance.index');
            }
        }

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $performance = Performance::destroy($id);
    }
}
