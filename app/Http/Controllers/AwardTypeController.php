<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AwardType;
use Alert;

class AwardTypeController extends Controller
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
        $award_types = AwardType::paginate(10);
        return view('award.award-type.index',compact('award_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('award.award-type.create');
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
            'name' => 'required|string|max:191|unique:award_types',
        ]);
        AwardType::create($request->all());
        Alert::success('Award Type Added Successfully.'); 
        return redirect(route('award-type.index'));
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
        $award_type = AwardType::findOrFail($id);
        return view('award.award-type.edit',compact('award_type'));
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

        $awardType = AwardType::findOrFail($id);

        $this->validate($request,[
            'name' => 'required|string|max:191|unique:award_types,name,'.$awardType->id,
        ]);

        $awardType['name'] = $request->name;
        $awardType['description'] = $request->description;

        $awardType->update();

        Alert::success('Award Type Updated Successfully.'); 
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
        return AwardType::destroy($id);
    }
}
