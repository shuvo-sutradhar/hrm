<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Equipment;
use App\AssetType;
use Alert;

class EquipmentController extends Controller
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
        $equipments = Equipment::paginate(10);
        return view('asset.equipment.index',compact('equipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $assetType = AssetType::pluck('name','id')->all();
        return view('asset.equipment.create',compact('assetType'));
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
        //
        $this->validate($request, [
            'name' => 'required|string|max:191|unique:equipment',
            'asset_type_id' => 'required|integer',
            'model' => 'required|string',
            'serial_no' => 'required|string'

        ]);
        //
        Equipment::create([
            'name' => $request['name'],
            'asset_type_id' => $request['asset_type_id'],
            'model' => $request['model'],
            'serial_no' => $request['serial_no'],
            'description' => $request['description']
        ]);

        Alert::success('Equipment Added Successfully.'); 
        return redirect(route('equipment.index'));
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
        $equipment = Equipment::findOrFail($id);
        $assetType = AssetType::pluck('name','id')->all();
        return view('asset.equipment.edit',compact('equipment','assetType'));
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
        $equipment = Equipment::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191|unique:equipment,name,'.$equipment->id,
            'asset_type_id' => 'required|integer',
            'model' => 'required|string',
            'serial_no' => 'required|string'
        ]);

        $equipment['name'] = $request['name'];
        $equipment['asset_type_id'] = $request['asset_type_id'];
        $equipment['model'] = $request['model'];
        $equipment['serial_no'] = $request['serial_no'];
        $equipment['description'] = $request['description'];
        $equipment->update();

        Alert::success('Equipment Updated Successfully.'); 
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
        return Equipment::destroy($id);
    }
}
