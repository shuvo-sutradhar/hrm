<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Route;
use Alert;

class RouteController extends Controller
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
        $routes = Route::paginate(10);
        return view('company-setting.route.index',compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company-setting.route.create');
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
            'name' => 'required|string|max:191|unique:routes',
            'location' => 'required'
        ]);
        //
        Route::create([
            'name' => $request['name'],
            'location' => $request['location'],
            'description' => $request['description']
        ]);

        Alert::success('Route Added Successfully.'); 
        return redirect(route('route.index'));
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
        $route = Route::findOrFail($id);
        return view('company-setting.route.edit',compact('route'));
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
        $route = Route::findOrFail($id);
        $this->validate($request, [
            'name' => 'required|string|max:191|unique:routes,name,'.$route->id,
            'location' => 'required',
        ]);
        

        $route['name'] = $request['name'];
        $route['location'] = $request['location'];
        $route['description'] = $request['description'];
        $route->update();

        Alert::success('Route Updated Successfully.'); 
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
        return Route::destroy($id);
    }
}
