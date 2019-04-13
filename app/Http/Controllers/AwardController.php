<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Award;
use App\AwardType;
use Alert;


class AwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $awards = Award::paginate(10);
        return view('award.index', compact('awards'));
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
        $awardTypes = AwardType::pluck('name','id')->all();
        return view('award.create', compact('employees','awardTypes'));

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
            'employee_id'   => 'required|integer',
            'award_type_id' => 'required|integer',
            'gift'          => 'required|string',
            'amount'        => 'required|integer',
            'month'         => 'required|string',
            'year'          => 'required|integer',
        ]);


        $input['employee_id']   = $request->employee_id;
        $input['award_type_id'] = $request->award_type_id;
        $input['gift']          = $request->gift;
        $input['amount']        = $request->amount;
        $input['month']         = $request->month;
        $input['year']          = $request->year;
        
        if($file = $request->file('award_img')){
            $name = time() . $input['gift'].'.'.$file->getClientOriginalExtension();
            $file->move('admin-assets/media/award',$name);
            $input['award_img'] = $name;
        }

        $input['description']   = $request->description;

        Award::create($input);
        Alert::success('Award Has Been Given Successfully.'); 
        return redirect(route('award.index'));
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
        $award = Award::findOrFail($id);

        $employees = User::pluck('name','id')->all();
        $awardTypes = AwardType::pluck('name','id')->all();

        return view('award.edit', compact('award','employees','awardTypes'));
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
        $award = Award::findOrFail($id);

        //
        $this->validate($request,[
            'employee_id'   => 'required|integer',
            'award_type_id' => 'required|integer',
            'gift'          => 'required|string',
            'amount'        => 'required|integer',
            'month'         => 'required|string',
            'year'          => 'required|integer',
        ]);


        $award['employee_id']   = $request->employee_id;
        $award['award_type_id'] = $request->award_type_id;
        $award['gift']          = $request->gift;
        $award['amount']        = $request->amount;
        $award['month']         = $request->month;
        $award['year']          = $request->year;
        
        if($file = $request->file('award_img')){

            if($award->award_img) {
                unlink('admin-assets/media/award/'. $award->award_img);  
            }

            $name = time() . $award['gift'].'.'.$file->getClientOriginalExtension();
            $file->move('admin-assets/media/award',$name);
            $award['award_img'] = $name;
        }

        $award['description']   = $request->description;

        $award->update();
        Alert::success('Award Has Been Given Successfully.'); 
        return redirect(route('award.index'));
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
        $award = Award::findOrFail($id);

        if($award->award_img) {
            unlink('admin-assets/media/award/'. $award->award_img);        
        }

        $award->delete();

    }
}
