<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Cuntry;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cities = City::orderBy('id', 'desc')->paginate(5);
        return response()->view('cms.cities.index',compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cuntries = Cuntry::all();
        return response()->view('cms.cities.create',compact('cuntries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cities = new City();

        $cities->name = $request->get('name');
        $cities->street = $request->get('street');
        $cities->contry_id = $request->get('cuntry_id');


        $issave = $cities->save();


        if ($issave) {


            return response()->json(['icon' => 'success', 'title' => 'sucsse']);
        } else {

            return response()->json(['icon' => 'error', 'title' => 'error'], 400);
        }
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

        $cities = City::findOrFail($id);
        $cuntries = Cuntry::all();

        return response()->view('cms.cities.edita',compact('cities' ,'cuntries'));

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
        $cities = City::findOrFail($id);

        $cities->name = $request->get('name');
        $cities->street = $request->get('street');
        $cities->contry_id = $request->get('cuntry_id');


        $issave = $cities->save();

        return ['redirect' => route('cities.index')];


        if ($issave) {


            return response()->json(['icon' => 'success', 'title' => 'sucsse']);
        } else {

            return response()->json(['icon' => 'error', 'title' => 'error'], 400);
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
        $city = City::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'top'], 200);

    }
}
