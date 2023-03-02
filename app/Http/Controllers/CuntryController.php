<?php

namespace App\Http\Controllers;

use App\Models\Cuntry;
use Illuminate\Http\Request;

class CuntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cuntries = Cuntry::withCount('cities')->orderBy('id', 'desc')->paginate(5);
        return response()->view('cms.cuntries.index',compact('cuntries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.cuntries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuntries = new Cuntry();

        $cuntries->name = $request->get('name');
        $cuntries->code = $request->get('code');


        $issave = $cuntries->save();


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

        $cuntries = Cuntry::findOrFail($id);
        return response()->view('cms.cuntries.edita',compact('cuntries'));

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
        $cuntries = Cuntry::findOrFail($id);

        $cuntries->name = $request->get('name');
        $cuntries->code = $request->get('code');


        $issave = $cuntries->save();

        return ['redirect' => route('countries.index')];


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
        $country = Cuntry::destroy($id);
        return response()->json(['icon' => 'success', 'title' => 'top'], 200);

    }
}
