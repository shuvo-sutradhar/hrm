<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Equipment;
use App\AssetAssignment;
use Alert;

class AssetAssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $assetAssigns = AssetAssignment::paginate(2);
        return view('asset.asset-assign.index', compact('assetAssigns'));
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
        $equipments = Equipment::pluck('name','id')->all();
        return view('asset.asset-assign.create', compact('employees','equipments'));
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
            'employee_id' => 'required|integer',
            'equipment_id.*' => 'required|integer',
        ]);



        //------------------------------
        $equipments = $request->equipment_id;
        $employee_id = $request->employee_id;
        foreach ($equipments as $equipment)
        {

            $assetAssignment = AssetAssignment::create([

                'employee_id' => $employee_id,
                'equipment_id' => $equipment,
                'details' => $request->details

            ]);
        }

        Alert::success('Asset Assign To Employee Successfully.'); 
        return redirect(route('asset-assign.index'));
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
        $assetAssignment = AssetAssignment::findOrFail($id);
        $equipments = Equipment::pluck('name','id')->all();
        $employees = User::pluck('name','id')->all();
        return view('asset.asset-assign.edit', compact('employees','equipments','assetAssignment'));
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
        return AssetAssignment::destroy($id);
    }
}
