<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AssetType;
use Alert;

class AssetTypeController extends Controller
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
        $asset_types = AssetType::paginate(10);
        return view('asset.asset-type.index',compact('asset_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('asset.asset-type.create');
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
            'name' => 'required|string|max:191|unique:asset_types'
        ]);
        //
        AssetType::create([
            'name' => $request['name'],
            'description' => $request['description']
        ]);

        Alert::success('Asset Type Added Successfully.'); 
        return redirect(route('asset-type.index'));
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
        $asset_type = AssetType::findOrFail($id);
        return view('asset.asset-type.edit',compact('asset_type'));
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
        $asset_type = AssetType::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191|unique:asset_types,name,'.$asset_type->id,
        ]);

        $asset_type['name'] = $request['name'];
        $asset_type['description'] = $request['description'];
        $asset_type->update();

        Alert::success('Asset Type Updated Successfully.'); 
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
        return AssetType::destroy($id);
    }
}
